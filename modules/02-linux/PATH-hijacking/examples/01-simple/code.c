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
