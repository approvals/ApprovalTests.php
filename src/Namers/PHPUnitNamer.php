<?php namespace ApprovalTests\Namers;

class StackTraceMetadata
{
    /**
     * @var bool
     */
    public $isPHPUnitTest;

    /**
     * @var bool
     */
    public $isReflection;

    /**
     * @var string|null
     */
    public $testDirectory;

    public $class;

    public $function;

    /**
     * @var array
     */
    public $stackTraceLine;

    public function __construct(array $stackTraceLine, array $prevStackTraceLine) {
        if (array_key_exists('file', $stackTraceLine)) {
            $this->isPHPUnitTest = self::isPHPUnitTest($stackTraceLine['file']);
        } else {
            $this->isPHPUnitTest = false;
        }
        if (array_key_exists('file', $prevStackTraceLine)) {
            $this->testDirectory = dirname($prevStackTraceLine['file']);
        } else {
            $this->testDirectory = null;
        }
        $this->isReflection = self::isReflection($stackTraceLine);
        $this->stackTraceLine = $stackTraceLine;
        $this->class = $stackTraceLine['class'];
        $this->function = $stackTraceLine['function'];
    }

    public static function isPHPUnitTest($path)
    {
        $expectedLocalPath = implode(DIRECTORY_SEPARATOR, ['', 'phpunit', 'src', 'Framework', 'TestCase.php']);
        $expectedPharPath = implode('/', ['', 'phpunit', 'Framework', 'TestCase.php']);
        return self::endsWith($path, $expectedLocalPath) || self::endsWith($path, $expectedPharPath);
    }

    public static function isReflection($stackTraceLine)
    {
        return $stackTraceLine['class'] === 'ReflectionMethod' && $stackTraceLine['function'] === 'invokeArgs';
    }

    private static function endsWith($haystack, $needle)
    {
        // https://stackoverflow.com/a/834355/25507
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    public function __toString(): string {
        return "[PHPUnit,class,method,reflection,testDirectory]="
            ."[{$this->isPHPUnitTest},{$this->class},{$this->function},{$this->isReflection},{$this->testDirectory}]";
    }
}

class PHPUnitNamer implements Namer
{
    private $caller;
    private $testDirectory;

    /**
     * PHPUnitNamer constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $metadata = self::getStackTrace();
        $this->caller = $metadata->stackTraceLine;
        $this->testDirectory = $metadata->testDirectory;
    }

    private static function getStackTrace()
    {
        $stackTraceLines = debug_backtrace(false);
        $stackTraceMetadata = [];
        for ($i = 1; $i < count($stackTraceLines); $i++) {
            $metadata = new StackTraceMetadata($stackTraceLines[$i], $stackTraceLines[$i - 1]);
            $stackTraceMetadata[] = $metadata;
        }
        for ($i = 0; $i < count($stackTraceMetadata); $i++) {
            $metadata = $stackTraceMetadata[$i];
            if ($metadata->isPHPUnitTest) {
                return $stackTraceMetadata[$metadata->isReflection ? $i - 1 : $i];
            }
        }
        throw new \Exception("Failed to identify the testing framework you are using; currently PHPUnit 5-8 is supported. Please raise a bug if you find this.");
    }

    public function getApprovedFile($extensionWithoutDot)
    {
        return $this->getFile('approved', $extensionWithoutDot);
    }

    public function getReceivedFile($extensionWithoutDot)
    {
        return $this->getFile('received', $extensionWithoutDot);
    }

    private function getFile($status, $extensionWithoutDot)
    {
        return $this->getApprovalsDirectory()
            . DIRECTORY_SEPARATOR . $this->getCallingTestClassNameWithoutNamespace()
            . '.' . $this->getCallingTestMethodName()
            . '.' . $status
            . '.' . $extensionWithoutDot;
    }

    public function getCallingTestClassName()
    {
        return $this->caller['class'];
    }

    public function getCallingTestClassNameWithoutNamespace()
    {
        return array_values(
            array_slice(
                explode('\\', $this->getCallingTestClassName()),
                -1
        ))[0];
    }

    public function getCallingTestMethodName()
    {
        return $this->caller['function'];
    }

    public function getCallingTestDirectory()
    {
        return $this->testDirectory;
    }

    public function getApprovalsDirectory()
    {
        return $this->getCallingTestDirectory() . DIRECTORY_SEPARATOR . 'approvals';
    }
}
