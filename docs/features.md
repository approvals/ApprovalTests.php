<!--
This file was generate by MarkdownSnippets.
Source File: /docs/features.source.md
To change this file edit the source file and then re-run the generation using either the dotnet global tool (https://github.com/SimonCropp/MarkdownSnippets#githubmarkdownsnippets) or using the api (https://github.com/SimonCropp/MarkdownSnippets#running-as-a-unit-test).
-->
# Features

## Verifying Objects as JSON

If you need a nice way of printing objects, JSON works very well.  Here's an example.

<!-- snippet: verify_as_json -->
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
<sup>[snippet source](/tests/ApprovalTest.php#L42-L56)</sup>
<!-- endsnippet -->

will create the approved file

<!-- snippet: tests/approvals/ApprovalTest.testVerifyAsJson.approved.txt -->
```txt
{
    "color": "black",
    "category": "hue",
    "type": "primary",
    "code": {
        "rgba": [
            255,
            255,
            255,
            1
        ],
        "hex": "#000"
    }
}
```
<sup>[snippet source](/tests/approvals/ApprovalTest.testVerifyAsJson.approved.txt#L1-L14)</sup>
<!-- endsnippet -->
