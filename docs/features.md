# Features

## Verifying Objects as JSON

If you need a nice way of printing objects, JSON works very well.

*Note*: ApprovalTests will sort your fields alphabetically so that you have consistency in your JSON.

Here's an example.

<!-- snippet: verify_as_json -->
<a id='snippet-verify_as_json'></a>
```php
public function testVerifyAsJson()
{
    $obj = [
        "color" => "black",
        "category" => "hue",
        "type" => "primary",
        "code" => [
            "rgba" => [255, 255, 255, 1],
            "hex" => "#000",
        ]
    ];
    Approvals::verifyAsJson($obj);
}
```
<sup><a href='/tests/ApprovalTest.php#L44-L58' title='Snippet source file'>snippet source</a> | <a href='#snippet-verify_as_json' title='Start of snippet'>anchor</a></sup>
<!-- endSnippet -->

will create the approved file

<!-- snippet: tests/approvals/ApprovalTest.testVerifyAsJson.approved.txt -->
<a id='snippet-tests/approvals/ApprovalTest.testVerifyAsJson.approved.txt'></a>
```txt
{
    "category": "hue",
    "code": {
        "hex": "#000",
        "rgba": [
            255,
            255,
            255,
            1
        ]
    },
    "color": "black",
    "type": "primary"
}
```
<sup><a href='/tests/approvals/ApprovalTest.testVerifyAsJson.approved.txt#L1-L14' title='Snippet source file'>snippet source</a> | <a href='#snippet-tests/approvals/ApprovalTest.testVerifyAsJson.approved.txt' title='Start of snippet'>anchor</a></sup>
<!-- endSnippet -->
