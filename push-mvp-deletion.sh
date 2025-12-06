#!/bin/bash
# Script to push the deletion of all files from R-=-MVP branch
#
# This script should be run by a user with appropriate repository permissions
# after reviewing the changes in DELETION_SUMMARY.md

set -e

echo "================================================"
echo "Push Deletion of All Files from R-=-MVP Branch"
echo "================================================"
echo ""

# Check if we're in a git repository
if [ ! -d ".git" ]; then
    echo "Error: Not in a git repository"
    exit 1
fi

# Fetch the latest changes
echo "Fetching latest changes..."
git fetch origin

# Check if the local R-=-MVP branch exists with the deletion commit
if git rev-parse R-=-MVP >/dev/null 2>&1; then
    echo "Local R-=-MVP branch found"
    
    # Get the commit hash
    LOCAL_COMMIT=$(git rev-parse R-=-MVP)
    echo "Local commit: $LOCAL_COMMIT"
    
    # Check if this commit removes files
    FILE_COUNT=$(git ls-tree -r R-=-MVP | wc -l)
    echo "Files in R-=-MVP branch: $FILE_COUNT"
    
    if [ "$FILE_COUNT" -eq 0 ]; then
        echo ""
        echo "✅ Confirmed: R-=-MVP branch has no files"
        echo ""
        echo "⚠️  WARNING: This will remove ALL files from the remote R-=-MVP branch!"
        echo "   Press Ctrl+C to cancel, or Enter to continue..."
        read
        
        # Push the changes
        echo ""
        echo "Pushing changes to remote R-=-MVP branch..."
        git push origin R-=-MVP
        
        echo ""
        echo "✅ Successfully pushed deletion to remote R-=-MVP branch"
        echo ""
        echo "To verify, run: git ls-tree -r origin/R-=-MVP"
    else
        echo ""
        echo "Error: R-=-MVP branch still contains $FILE_COUNT files"
        echo "Expected 0 files. Please ensure the branch has been properly cleaned."
        exit 1
    fi
else
    echo "Error: Local R-=-MVP branch not found"
    echo ""
    echo "To create it with the deletion commit, run:"
    echo "  git checkout -b R-=-MVP 7ec484d"
    exit 1
fi
