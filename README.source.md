[![Build Status](https://travis-ci.org/mattcan/approval-tests.svg?branch=master)](https://travis-ci.org/mattcan/approval-tests)

ApprovalTests.PHP
=================
Capturing Human Intelligence - ApprovalTests is an open source assertion/verification library to aid unit testing.

It is compatible with PHPUnit

What can it be used for?
---

Approval Tests can be used for verifying objects that require more than a simple assert. They also come prepackaged with utilities for some common scenarios including

- HashMaps & Collections
- Long Strings
- Log Files
- Xml
- Html
- Json (see [features](docs/features.md))

How to get it
---
It's on [Packagist](https://packagist.org/packages/approvals/approval-tests);
search for 'approval-tests'. If you're using Composer, you can add it as follows:

```sh
composer req --dev approvals/approval-tests
```

[Video Tutorials](http://www.youtube.com/playlist?list=PLFBA98F47156EFAA9&feature=view_all)
---

You can watch a bunch of short videos on getting started and [using ApprovalTests](http://www.youtube.com/playlist?list=PLFBA98F47156EFAA9&feature=view_all) at YouTube.
These cover approval tests in Java and .NET, but the same concepts apply.

Podcasts
---
If you prefer auditory learning, you might enjoy the following podcast (Note: Some of these talk about the .Net and Java side)

- [Cucumber Podcast](https://cucumber.io/blog/2017/01/26/approval-testing)
- [Hanselminutes](http://www.hanselminutes.com/360/approval-tests-with-llewellyn-falco)
- [Herding Code](http://www.developerfusion.com/media/122649/herding-code-117-llewellyn-falcon-on-approval-tests/)
- [The Watir Podcast](http://watirpodcast.com/podcast-53/)



Examples
---
ApprovalTests eats it own dogfood, so the best examples are in the source code itself.

None the less,  Here's a quick look at some
[Sample Code](https://github.com/approvals/ApprovalTests.php/blob/9ce5bbd043ea2720bdfe5bbdf25f23a225329485/tests/ApprovalTest.php#L8)

snippet: array_example

Will Produce a File

snippet: tests/approvals/ApprovalTest.testVerifyArray.approved.txt

Simply rename this to ApprovalTest.testVerifyArray.approved.txt and the test will now pass.

Approved File Artifacts
---

The `*.approved.*` files must be checked into source your source control.
This can be an issue with git as it will change the line endings.
The suggested fix is to add
`*.approved.* binary` to your `.gitattributes`

More Info
---

- [Website](http://approvaltests.sourceforge.net/)
- [Blog](http://blog.approvaltests.com/)
- [Getting Started Doc](https://github.com/approvals/ApprovalTests.Java/blob/master/build/resources/approval_tests/documentation/ApprovalTests%20-%20GettingStarted.md)


## LICENSE
[Apache 2.0 License](https://github.com/SignalR/SignalR/blob/master/LICENSE.md)


Questions?
---

twitter: [@LlewellynFalco](https://twitter.com/#!/llewellynfalco) or [@notthatjoshkel](https://twitter.com/notthatjoshkel) or #ApprovalTests
