

#!/bin/sh

# Configuration
YUICOMPRESSOR_PATH="/usr/share/yui-compressor/yui-compressor.jar"

# if you want to enable it for specific directory set it here, by default its current dir
CURRENT_DIR=$PWD

# First argument must be either css / js
TYPE=$1

# Let's begin...
echo ".........................................."
echo 
echo "Preparing to minimize $1..."
echo 
echo ".........................................."
echo 

# Status messages
ERROR_DISPLAY="[error]"
OK_DISPLAY="[ok]"

create_directory_if_not_exist() {
  # check if directory exists
  if [ ! -d $1 ];
  then
   mkdir -p $1 >/dev/null 2>&1 ||  echo "Error: Failed to create $1 directory. $ERROR_DISPLAY"
  fi
}

[ -z $TYPE ] && \
  echo "First argument missing, it should be either css or js. $ERROR_DISPLAY" && \
  exit 0

[ $TYPE != 'js' ] && [ $TYPE != 'css' ] && \
  echo "First argument must be either css or js. $ERROR_DISPLAY" && \
  exit 0

[ -z $YUICOMPRESSOR_PATH ] || [ ! -f $YUICOMPRESSOR_PATH ] && \
  echo "YUICOMPRESSOR_PATH must be correctly set. $ERROR_DISPLAY" && \
  exit 0

# If second argument is not null use it as current directory
if [ ! -z "$2" ];
then
  # Make all path absolute
   [[ $2 = /* ]] && \
   CURRENT_DIR=$2 || \
   CURRENT_DIR="$PWD/$2"
fi
echo "Minifying all $TYPE files recursively in $CURRENT_DIR $OK_DISPLAY"

for file in `find $CURRENT_DIR -name "*.$TYPE"`
  do   
    # Get the current file directory
    FILE_DIRECTORY=$(dirname $file)
    # Get the basename of the current directory
    BASE_DIR_NAME=`basename $FILE_DIRECTORY`

    if  [ ${file: -8} != ".min.css" ] && [ ${file: -6} != "min.js" ] 
    then
      # Get the current file name
      BASE_FILE_NAME=`basename $file`
      MINIFIED_FILE_NAME=${BASE_FILE_NAME%$TYPE}min.$TYPE
      # Minified directory path for the current file
      MINIFIED_FILE_DIRECTORY="$FILE_DIRECTORY"
      create_directory_if_not_exist $MINIFIED_FILE_DIRECTORY

      MINIFIED_OUTPUT_FILE="$MINIFIED_FILE_DIRECTORY/$MINIFIED_FILE_NAME"
      echo "Compressing $file $OK_DISPLAY"
      java -jar $YUICOMPRESSOR_PATH --type $TYPE -o $MINIFIED_OUTPUT_FILE $file
    fi
  done
 
echo ".........................................."
echo 
echo "$1 minified"
echo 
echo ".........................................."
echo 