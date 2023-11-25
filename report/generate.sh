#!/usr/bin/env sh

# Author: Leonardo Tamiano
#
# 
# Inspired from the script of Alexandre ZANNI
#
# https://github.com/noraj/OSCP-Exam-Report-Template-Markdown
# 

# extract root directory where the script resides, regardless from
# where we call the script
ROOT=$(dirname $(realpath $0))

# CHANGE, with your OSID value
OSID=99999999

# This can also be supplied from the command line
#
# ./generate.sh <input-file>.md
# ./generate.sh <input-file>.org 
# 
INPUT_PATH=$ROOT/report.md

# DO NOT CHANGE, these are fixed by OffSec policy
# https://help.offsec.com/hc/en-us/articles/360040165632-OSCP-Exam-Guide#section-3-submission-instructions
REPORT_PDF_PATH="${ROOT}/OSCP-OS-${OSID}-Exam-Report.pdf"
ARCHIVE_NAME="${ROOT}/OSCP-OS-${OSID}-Exam-Report.7z"

# ANSII ESCAPE codes for colors
RED='\033[0;31m'
NC='\033[0m'

# ----------------------------

check_requirements() {
    # if we receive a CLI arg, check that it points to an existing
    # markdown or org-mode file
    if [ $# -eq 1 ] && [ -f $1 ]; then
	filename=$(basename -- $1)
	extension="${filename##*.}"
	[ ! "$extension" = "org" ] && [ ! "$extension" = "md" ] \
	    && echo "[ERROR]: Input file can only be '.org' or '.md'" && exit;

	INPUT_PATH=$1
    fi    
    
    # otherwise use the pre-defined value
    [ ! -f $INPUT_PATH ] && echo "[ERROR]: missing input report!" && exit;

    # has the OSID been set?
    # https://stackoverflow.com/questions/3601515/how-to-check-if-a-variable-is-set-in-bash
    [ -z "${OSID}" ] && echo "[ERROR]: missing OSID!" && exit;
    
    # is pandoc installed?
    which pandoc >/dev/null 2>&1
    [ $? -eq 1 ] && echo "[ERROR]: missing pandoc!" && exit;

    # is 7z installed?
    which 7z >/dev/null 2>&1
    [ $? -eq 1 ] && echo "[ERROR]: missing 7z!" && exit;    

    # TODO: do we have the eisvogel theme?
}

# -----

md2pdf() {
    REPORT_MD_PATH=$1
    REPORT_PDF_PATH=$2
    
    pandoc $REPORT_MD_PATH -o $REPORT_PDF_PATH \
	   --from markdown+yaml_metadata_block+raw_html \
	   --template eisvogel \
	   --listing \
	   -V colorlinks=true \
	   -V linkcolor=orange \
	   -V urlcolor=orange \
	   -V toccolor=black \
	   --table-of-contents \
	   --toc-depth 6 \
	   --number-sections \
	   --top-level-division=chapter \
	   --highlight-style zenburn \
	   --resource-path=.:src \
	   --resource-path=.:/usr/share/osert/src

    [ $? -eq 1 ] && echo "[ERROR]: Problems during generation of PDF!" && exit;
}

# -----

org2pdf() {
    REPORT_ORG_PATH=$1
    REPORT_PDF_PATH=$2

    pandoc $REPORT_ORG_PATH -o $REPORT_PDF_PATH \
	   --from org \
	   --template eisvogel \
	   --listing \
	   -V colorlinks=true \
	   -V linkcolor=orange \
	   -V urlcolor=orange \
	   -V toccolor=black \
	   -V titlepage=true \
	   -V titlepage-color="F2F3F5" \
	   -V titlepage-text-color="000000" \
	   -V titlepage-rule-color="000000" \
	   -V titlepage-rule-height=2 \
	   -V book=true \
	   -V classoption=oneside \
	   -V code-block-font-size=\\scriptsize \
	   --table-of-contents \
	   --toc-depth 6 \
	   --number-sections \
	   --top-level-division=chapter \
	   --highlight-style zenburn \
	   --resource-path=.:src \
	   --resource-path=.:/usr/share/osert/src
    
    [ $? -eq 1 ] && echo "[ERROR]: Problems during generation of PDF!" && exit;
}

# -----

main() {
    echo "[INFO]: Checking requirements"
    
    # we all good?
    check_requirements $@
    
    echo "[INFO]: All good, we're ready to generate!"

    # Ok, generate!
    [ "${INPUT_PATH##*.}" = "org" ] && \
	echo "[INFO]: org->pdf" && \
	org2pdf $INPUT_PATH $REPORT_PDF_PATH
    
    [ "${INPUT_PATH##*.}" = "md" ] && \
	echo "[INFO]: md->pdf" && \
	md2pdf $INPUT_PATH $REPORT_PDF_PATH

    # Create 7z archive
    echo "[INFO]: Generated succesfully, creating 7z archive!"
    7z a $ARCHIVE_NAME $REPORT_PDF_PATH >/dev/null 2>/dev/null
    [ $? -eq 1 ] && echo "[ERROR]: Problems during 7z archive creation!" && exit;

    # # output MD5 hash
    MD5=$(md5sum OSCP-OS-99999999-Exam-Report.7z | awk -F '  ' '{print $1}')
    [ $? -eq 1 ] && echo "[ERROR]: Problems during computation of MD5" && exit;
    
    printf "[INFO]: MD5 of archive (${RED}${MD5}${NC})\n"
}

# ----------------------------

main $@
