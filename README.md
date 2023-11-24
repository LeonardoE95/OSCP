# OSCP

This repository contains useful information related to the OSCP certification. 

I have organized all the knowledge you need to know in order to obtain
the OSCP certification in the following nine modules. For each module,
you will find a specific folder containing information regarding that
module. The modules are listed below.

**NOTE**: Currently there's not much in these modules, because I just
started to work on this. In the following months you should see more
content coming.

- [01 – Web](./modules/01-web)
- [02 – Linux](./modules/02-linux)
- [03 – Windows](./modules/02-windows)
- [04 – Password Attacks](./modules/04-password-attacks)
- [05 – Using Existing Exploits](./modules/05-using-existing-exploits)
- [06 – Port Forwarding and Pivoting](./modules/06-port-forwarding-and-pivoting)
- [07 – Client-side Attacks](./modules/07-client-side-attacks)
- [08 – Active Directory](./modules/08-active-directory)
- [09 – Report Writing](./modules/09-report-writing)

Other material that I developed regarding OSCP

- [Blog post – OSCP Technical Guide](https://blog.leonardotamiano.xyz/tech/oscp-technical-guide/)
  
- [Youtube Playlist – Hexdump](https://www.youtube.com/watch?v=9mrf-WyzkpE&list=PLJnLaWkc9xRgOyupMhNiVFfgvxseWDH5x)

- [Cheatsheet](./cheatsheet.org)

# Report
In the `./report` folder you will find a folder ready to be used for
the final exam. To generate the report, make sure you have `pandoc`
installed with the latex theme `eisvogel`. If you do not have such
file I suggest to download it from github.

```
wget https://raw.githubusercontent.com/Wandmalfarbe/pandoc-latex-template/master/eisvogel.tex
```

Then, edit the script `./report/generate.sh` in order to insert your own `OSID`
value. So for example assuming my `OSID` was `99999999` then I would
write on top of the file

```
OSID=99999999 
```

Finally, just execute `./generate.sh`, and you should see the
following

```
[leo@archlinux report]$ ./generate.sh 
[INFO]: Checking requirements
[INFO]: All good, we're ready to generate!
[INFO]: Generated succesfully, creating 7z archive!
[INFO]: MD5 of archive (e9b9424d742bf230748665cd614ba240)
```

After the script has succesfully executed, you will see two new files:

- `OSCP-OS-99999999-Exam-Report.pdf`, which contains the generated pdf for previewing
- `OSCP-OS-99999999-Exam-Report.7z`, which contains the final artifat you can use to submit your record. 

Finally, notice how at the end the MD5 of the artifact is computed. This can be used during OffSec upload procedure to make sure you uploaded the correct file.
