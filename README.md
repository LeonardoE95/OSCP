# OSCP

This repository contains cheatsheet and other information related to the OSCP certification.

## Report Generation

In the `./exam` folder you will find the basic structure I used for the generation of the final report. To generate the final report

1. Write your `OSID` value within the `.input.txt`, replacing the current value of `99999999`

```txt
0
./OSCP-report.md
.
0
99999999           # replace this with your OSID
n
n
```

2. Write all the content of the report within the `OSCP-report.md` file using markdown

3. Execute the following

and then execute the following

```sh
./generate.sh
```

To make this work you need some dependencies such as `pandoc`. After
the script has succesfully executed, you will see two new files:
`OSCP-OS-99999999-Exam-Report.pdf`, which contains the generated pdf
for previewing, and `OSCP-OS-99999999-Exam-Report.7z` which contains
the final artifat you can use to submit your record. Notice also how
the MD5 of the artifact is computed

```
[+] Archive generated at ./OSCP-OS-99999999-Exam-Report.7z
[+] Calculating MD5 of the archive...
[+] Archive MD5 (upload integrity check): 03abf1219eb4150068204bcd14600a15
```

This can be used during OffSec upload procedure to make sure you uploaded the correct file.

I thank Alexandre ZANNI, the author of the `.osert.rb` script. You can
find this project on GitHub:
https://github.com/noraj/OSCP-Exam-Report-Template-Markdown.

  
