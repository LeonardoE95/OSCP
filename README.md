# OSCP

This repository contains useful information related to the OSCP certification. 

Specifically, I have organized all the knowledge you need to know in
order to obtain the OSCP certification into nine different
modules. For each module, you will find a specific folder containing
information regarding that module. The modules are listed below.

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

# 01 – Web

For the `web` module the following topics have been covered.

- [X] [Introduction to Web Exploitation](./modules/01-web/01-introduction-to-web-exploitation)
- [X] [Getting used to burpsuite](01-web/02-getting-used-to-burpsuite)
- [ ] SQL Injection
- [ ] Directory Traversal
- [ ] File Inclusion
- [ ] File Upload
- [ ] Command Injection
- [ ] Cross-Site Scripting

# 02 – Linux

For the `linux` module the following topics have been covered.

- [ ] System shell
- [X] [PATH Hijacking](./modules/02-linux/PATH-hijacking)
- [ ] SUID exploitation
- [ ] System enumeration
- [ ] Cronjob enumeration
- [ ] SUDO exploitation
- [ ] Wildcard expansion

# 03 – Windows

For the `windows` module the following topics have been covered.

- [ ] System shell
- [ ] System enumeration
- [ ] Useful system commands
- [ ] SeImpersonatePrivilege Exploitation
- [ ] Service Hijacking Exploitation
- [ ] Unquoted Service Paths Exploitation

# 04 – Password Attacks

For the `password attacks` module the following topics have been covered.

- [ ] Hash cracking theory
- [ ] Hash cracking tools
- [ ] KeePass databases
- [ ] Ssh keys
- [ ] NTLM hash
- [ ] Net-NTLMv2 hash
- [ ] AS-REP hash
- [ ] Kerberoasting hash

# 05 – Using Existing Exploits

For the `using existing exploits` module the following topics have been covered.

- [ ] Metasploit
- [ ] exploit-db
- [ ] CVE-2021-41773

# 06 – Port Forwarding and Pivoting

For the `port forwarding and pivoting` module the following topics have been covered.

- [ ] Local Port Forwarding
- [ ] Dynamic Port Forwarding
- [ ] Remote Port Forwarding
- [ ] Remote Dynamic Port Forwarding

# 07 – Client-side Attacks

For the `client-side attacks` module the following topics have been covered.

- [ ] Cross-Site Scripting
- [ ] Microsoft Word Macros
- [ ] Windows Library Files

# 08 – Active Directory

For the `active directory` module the following topics have been covered.

- [ ] Enumeration
- [ ] Main tools
- [ ] Kerberoasting
- [ ] AS-REP roasting
- [ ] DCsync attack
- [ ] Mimikatz
- [ ] NTLM authentication
- [ ] Kerberos authentication

# 09 – Report Writing

In the `./report` you will find a folder ready to be used for the
final exam. The idea is simple: you write your exam findings in a
report using either the `markdown` or `org` markup languages, and then
you can use the `generate.sh` script to generate a final PDF. Two
sample reports `report.md` and `report.org` are presented. You can
take inspiration from those and customize it to your own need.

To actually generate the report, make sure you have `pandoc` installed
with the latex theme `eisvogel`. If you do not have such file I
suggest to download it from github.

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

Notice how at the end the MD5 of the artifact is computed. This can be
used during OffSec upload procedure to make sure you uploaded the
correct file. Finally, if you want to change the input filename to
export, just give an argument to the `generate.sh` script as
follows. Just remember that the scripts only supports `markdown` and
`org` syntaxes.

```
./generate.sh report.md
./generate.sh report.org
```
