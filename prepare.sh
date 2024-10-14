#!/usr/bin/env bash

# This script runs on Github Actions to remove the solution from the master
# branch so that the repository can be used as a template for new job
# applications.

shopt -s globstar nullglob

CI=${CI:-false}
CANDIDATE_PROFILE=${CANDIDATE_PROFILE:=junior}

if [ "$CI" != "true" ]; then
    echo "Not running in CI. Aborting."
    exit 0
fi

# Copy common stubs
for file in ./**/*.stub
do
    dest="${file//.stub/}"
    echo "[common] Moving $file to $dest"
    mv "$file" "$dest"
done

# Delete common files marked for deletion
for file in ./**/*.delete
do
    file="${file//.delete/}"
    echo "[common]" Deleting "$file"
    rm "$file"
done

# Copy profile specific stubs
for file in ./**/*."$CANDIDATE_PROFILE"-stub
do
    dest="${file//."$CANDIDATE_PROFILE"-stub/}"
    echo "[$CANDIDATE_PROFILE] Moving $file to $dest"
    mv "$file" "$dest"
done

# Delete profile specific files marked for deletion
for file in ./**/*."$CANDIDATE_PROFILE"-delete
do
    file="${file//."$CANDIDATE_PROFILE"-delete/}"
    echo "[$CANDIDATE_PROFILE]" Deleting "$file"
    rm "$file"
done

# Delete dangling stubs
for file in ./**/*-stub
do
    echo "[cleanup]" Deleting unused stub "$file"
    rm "$file"
done

# Delete dangling deletion markers
for file in ./**/*-delete
do
    echo "[cleanup]" Deleting unused deletion marker "$file"
    rm "$file"
done
