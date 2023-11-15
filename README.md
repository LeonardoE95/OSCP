# OSCP

This repository contains cheatsheet and other information related to the OSCP certification. 

If you're interested in a meaningful outline of the material covered
by OSCP, go and read my article about it ([OSCP Technical
Guide](https://blog.leonardotamiano.xyz/tech/oscp-technical-guide/)).

If you're interested in video content, currently I'm working towards a
playlist covering technical material useful for OSCP. You can find it
in my english youtube channel: [Youtube –
Hexdump](https://www.youtube.com/watch?v=9mrf-WyzkpE&list=PLJnLaWkc9xRgOyupMhNiVFfgvxseWDH5x)

## Report Generation

In the `./exam` folder you will find the basic structure I used for the generation of the final report. To generate the final report you need to have installed `pandoc`. You also need to have installed the latex theme named `eisvogel`. This is the theme used by `pandoc` for exporting the markdown into the pdf file. If you do not have such file I suggest to download it from github

```
wget https://raw.githubusercontent.com/Wandmalfarbe/pandoc-latex-template/master/eisvogel.tex
```

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

```sh
./generate.sh
```

After the script has succesfully executed, you will see two new files:
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
find this project on GitHub: https://github.com/noraj/OSCP-Exam-Report-Template-Markdown.

  
