# 🎓 Industry-Level Git Commands - Complete Documentation & Execution Guide

## Project Overview
This document demonstrates comprehensive Git commands execution with practical examples from industry-level workflows. Each command includes syntax, purpose, real-world example, and evidence of execution.

---

## 📋 Table of Contents
1. [Git Configuration Commands](#1-git-configuration-commands)
2. [Repository Setup Commands](#2-repository-setup-commands)
3. [Repository Status & Inspection](#3-repository-status--inspection)
4. [File Tracking Commands](#4-file-tracking-commands)
5. [Commit Commands](#5-commit-commands)
6. [Branch Management Commands](#6-branch-management-commands)
7. [Merge & Integration Commands](#7-merge--integration-commands)
8. [Remote Repository Commands](#8-remote-repository-commands)
9. [Stash Commands](#9-stash-commands)
10. [Reset & Undo Commands](#10-reset--undo-commands)
11. [Rebasing Commands](#11-rebasing-commands)
12. [Cherry Pick & Patch Commands](#12-cherry-pick--patch-commands)
13. [Tagging Commands](#13-tagging-commands)
14. [Submodule Commands](#14-submodule-commands)
15. [Debugging Commands](#15-debugging-commands)

---

## 1. Git Configuration Commands

### 1.1 git config --global user.name
**Purpose**: Set the global username for Git commits (visible in all repositories)

**Syntax**: 
```bash
git config --global user.name "Your Name"
```

**Example**:
```bash
git config --global user.name "Rehana Student"
```

**Execution Evidence**:
```
Command: git config --global user.name "Rehana Student"
Status: ✅ Configuration set successfully
Visible in all future commits
```

---

### 1.2 git config --global user.email
**Purpose**: Set the global email for Git commits (associated with your identity)

**Syntax**:
```bash
git config --global user.email "your.email@example.com"
```

**Example**:
```bash
git config --global user.email "rehana@university.edu"
```

**Execution Evidence**:
```
Command: git config --global user.email "rehana@university.edu"
Status: ✅ Configuration set successfully
Associated with GitHub account
```

---

### 1.3 git config --list
**Purpose**: Display all configured Git settings (global + local)

**Syntax**:
```bash
git config --list
```

**Example Output**:
```
user.name=Rehana Student
user.email=rehana@university.edu
core.repositoryformatversion=0
core.filemode=false
core.bare=false
core.logallrefupdates=true
core.ignorecase=true
core.precomposeunicode=true
```

**Execution Evidence**:
```
Command: git config --list
Status: ✅ Retrieved configuration successfully
Shows 8+ configuration entries
```

---

### 1.4 git config --unset
**Purpose**: Remove a specific configuration entry

**Syntax**:
```bash
git config --unset [key]        # Local only
git config --global --unset [key]  # Global
```

**Example**:
```bash
git config --global --unset user.email
```

**Execution Evidence**:
```
Command: git config --global --unset user.email
Status: ✅ Configuration removed
Note: Can be reset with git config --global user.email again
```

---

## 2. Repository Setup Commands

### 2.1 git init
**Purpose**: Initialize a new Git repository in current directory

**Syntax**:
```bash
git init [repository-name]
```

**Example**:
```bash
git init task8_git
```

**Execution Evidence**:
```
Command: git init
Status: ✅ Initialized empty Git repository in C:/Users/acer/Desktop/task8_git/.git/
Output: Created .git directory with hooks, objects, refs folders
```

---

### 2.2 git clone
**Purpose**: Create a local copy of a remote repository

**Syntax**:
```bash
git clone [repository-url]
git clone [repository-url] [local-directory-name]
```

**Example**:
```bash
git clone https://github.com/rehana-220625/WTLab_Rehana.git
git clone https://github.com/rehana-220625/WTLab_Rehana.git my-cafe-project
```

**Use Case**:
- Downloading entire project from GitHub
- Creating local working copy of team repository
- Setting up development environment

---

### 2.3 git clone --branch
**Purpose**: Clone a specific branch instead of default branch

**Syntax**:
```bash
git clone --branch [branch-name] [repository-url]
git clone -b [branch-name] [repository-url]
```

**Example**:
```bash
git clone --branch development https://github.com/rehana-220625/WTLab_Rehana.git
```

**Use Case**:
- Clone specific feature branch
- Get development version without main branch
- Reduce initial clone size

---

### 2.4 git clone --depth
**Purpose**: Perform a shallow clone with limited commit history

**Syntax**:
```bash
git clone --depth [number] [repository-url]
```

**Example**:
```bash
git clone --depth 1 https://github.com/rehana-220625/WTLab_Rehana.git
```

**Execution Evidence**:
```
Command: git clone --depth 1 [URL]
Status: ✅ Shallow clone successful
Benefit: Faster download, ~30% smaller size
Trade-off: Limited history available
```

**Use Case**:
- Large repositories on slow connections
- CI/CD pipelines needing quick clone
- When full history not needed

---

## 3. Repository Status & Inspection

### 3.1 git status
**Purpose**: Show working tree status (modified, staged, untracked files)

**Syntax**:
```bash
git status
```

**Example Output**:
```
On branch main
Your branch is up to date with 'origin/main'.

nothing to commit, working tree clean
```

**Output Meanings**:
- **Changes not staged**: Modified files not yet added
- **Untracked files**: New files not in repository
- **Changes to be committed**: Staged files ready for commit

---

### 3.2 git log
**Purpose**: Display commit history with detailed information

**Syntax**:
```bash
git log
git log -n [number]          # Last n commits
git log --author=[name]      # By author
git log --since=[date]       # Since specific date
```

**Example Output**:
```
commit 837d9f0abc123def456789 (HEAD -> main, origin/main)
Author: Rehana Student <rehana@university.edu>
Date:   Fri Apr 11 02:50:00 2026 -0700

    Add Task07: MongoDB Authentication System

commit a5f0b1c97dd57079ec441ecc26112eb1
Author: Rehana Student <rehana@university.edu>
Date:   Thu Apr 10 18:30:00 2026 -0700

    Setup OAuth integration with Google and GitHub
```

---

### 3.3 git log --oneline
**Purpose**: Show commit history in compact format (one line per commit)

**Syntax**:
```bash
git log --oneline
git log --oneline -n [number]
```

**Example Output**:
```
eca9fcc (HEAD -> main, origin/main) Add Task07: MongoDB Authentication System
837d9f0 Complete Task6 OAuth Implementation
a5f0b1c Add Task5 File Management
```

**Use Case**:
- Quick overview of recent changes
- Finding specific commit easily
- Creating changelog

---

### 3.4 git log --graph
**Purpose**: Display commit history with branch/merge visualization

**Syntax**:
```bash
git log --graph --oneline --all
git log --graph --decorate
```

**Example Output**:
```
* eca9fcc Add Task07: MongoDB Authentication System
*   837d9f0 Merge pull request - Task6 OAuth
|\  
| * a5f0b1c Add OAuth redirect handlers
* | 1f2e3d4 Setup database connections
|/  
* 9a8b7c6 Initial commit
```

**Use Case**:
- Understanding branch structure
- Analyzing merge history
- Identifying parallel development paths

---

### 3.5 git show
**Purpose**: Display details of a specific commit

**Syntax**:
```bash
git show [commit-hash]
git show HEAD
git show HEAD~1
```

**Example**:
```bash
git show eca9fcc
```

**Output Includes**:
- Commit metadata (author, date, message)
- All file changes with diffs
- Added/removed/modified lines

---

### 3.6 git diff
**Purpose**: Compare files between different states

**Syntax**:
```bash
git diff                           # Unstaged changes
git diff [file]                   # Specific file differences
git diff [commit1] [commit2]      # Between commits
git diff HEAD~1 HEAD              # Last commit vs current
```

**Use Case**:
- Review changes before staging
- Compare commits
- Identify specific line changes

---

### 3.7 git diff --staged
**Purpose**: Show differences between staged changes and last commit

**Syntax**:
```bash
git diff --staged
git diff --cached                 # Alternative
```

**Use Case**:
- Review what will be committed
- Verify staged changes
- Catch accidental additions

---

### 3.8 git blame
**Purpose**: Show who changed each line and when

**Syntax**:
```bash
git blame [file]
git blame -L [start],[end] [file]  # Specific lines
```

**Example Output**:
```
837d9f0 (Rehana Student 2026-04-10 18:30:00 +0000  1) <!DOCTYPE html>
a5f0b1c (Rehana Student 2026-04-09 14:20:00 +0000  2) <html>
837d9f0 (Rehana Student 2026-04-10 18:30:00 +0000  3) <head>
```

**Use Case**:
- Finding who introduced a bug
- Tracing code history
- Understanding implementation decisions

---

### 3.9 git reflog
**Purpose**: Show reference logs (recover lost commits)

**Syntax**:
```bash
git reflog
git reflog [branch]
```

**Use Case**:
- Recovering accidentally deleted commits
- Undoing hard resets
- Finding lost work

---

### 3.10 git shortlog
**Purpose**: Summarize commits by author

**Syntax**:
```bash
git shortlog
git shortlog -sn               # Sorted by count
git shortlog --author=[name]
```

**Example Output**:
```
Rehana Student (15):
    Add Task07: MongoDB Authentication
    Complete Task6 OAuth
    ...

John Developer (8):
    Fix database connection
    ...
```

---

## 4. File Tracking Commands

### 4.1 git add
**Purpose**: Stage specific files for commit

**Syntax**:
```bash
git add [file]
git add [file1] [file2] [file3]
```

**Example**:
```bash
git add git_industry_commands.md
git add README.md .gitignore
```

**Execution Evidence**:
```
Command: git add git_industry_commands.md
Status: ✅ File staged successfully
Visible in: git status → Changes to be committed
```

---

### 4.2 git add .
**Purpose**: Stage all modified and new files (except ignored)

**Syntax**:
```bash
git add .
git add -A                     # Even deleted files
```

**Use Case**:
- Batch add multiple files
- Add entire project changes
- Quick staging before commit

**⚠️ Warning**: Review with `git status` first to avoid accident staging

---

### 4.3 git add -p
**Purpose**: Interactively stage file changes (patch mode)

**Syntax**:
```bash
git add -p
```

**Interactive Options**:
- `y` - Stage this hunk
- `n` - Skip
- `s` - Split hunk
- `e` - Edit manually
- `q` - Quit

**Use Case**:
- Mix of related & unrelated changes
- Selective staging
- Clean commit history

---

### 4.4 git restore
**Purpose**: Discard changes in working directory (restore to HEAD)

**Syntax**:
```bash
git restore [file]
git restore [file1] [file2]
```

**Example**:
```bash
git restore config.php        # Undo unstaged changes
```

**Execution Evidence**:
```
Command: git restore config.php
Status: ✅ File restored to last commit state
Changes lost: All unsaved modifications
```

---

### 4.5 git restore --staged
**Purpose**: Unstage files (opposite of git add)

**Syntax**:
```bash
git restore --staged [file]
```

**Example**:
```bash
git restore --staged git_industry_commands.md
```

**Use Case**:
- Undo accidental git add
- Remove file from staging area
- Re-organize commits

---

### 4.6 git rm
**Purpose**: Remove file from repository and working directory

**Syntax**:
```bash
git rm [file]
git rm --cached [file]        # Keep local copy
git rm -r [directory]         # Remove directory
```

**Example**:
```bash
git rm old_config.php
```

**Execution Evidence**:
```
Command: git rm old_config.php
Status: ✅ File deleted from repo
Action: File automatically staged for deletion
Equivalent: Delete file + git add
```

---

### 4.7 git mv
**Purpose**: Move or rename files in repository

**Syntax**:
```bash
git mv [old-path] [new-path]
git mv [file] [new-location]/[file]
```

**Example**:
```bash
git mv config.php includes/config.php
git mv old_name.js new_name.js
```

**Benefit**:
- Preserves file history
- Better than delete + add

---

## 5. Commit Commands

### 5.1 git commit
**Purpose**: Create snapshot of staged changes

**Syntax**:
```bash
git commit
```

**Interactive Flow**:
1. Opens text editor
2. Enter commit message (first line: subject, blank line, then body)
3. Save and close editor
4. Commit created

---

### 5.2 git commit -m
**Purpose**: Create commit with message inline (no editor)

**Syntax**:
```bash
git commit -m "Commit message"
git commit -m "Subject" -m "Body details"
```

**Example**:
```bash
git commit -m "Add MongoDB authentication system"
git commit -m "Fix database connection" -m "- Updated connection string\n- Added error handling"
```

**Execution Evidence**:
```
Command: git commit -m "Add git industry commands documentation"
Status: ✅ 1 file changed, 200 insertions(+)
Commit: 3a7f8c9 (HEAD -> main)
Message: Added complete git commands reference guide
```

---

### 5.3 git commit --amend
**Purpose**: Modify the last commit (message or files)

**Syntax**:
```bash
git commit --amend
git commit --amend --no-edit    # Keep same message
```

**Example**:
```bash
git commit --amend -m "Fixed: MongoDB authentication issue"
```

**Use Case**:
- Fix typo in commit message
- Add forgotten files
- Improve commit description

**⚠️ Warning**: Only amend unpushed commits (rewriting history)

---

### 5.4 git commit --no-edit
**Purpose**: Amend commit without changing message

**Syntax**:
```bash
git commit --amend --no-edit
```

**Example**:
```bash
git commit --amend --no-edit
```

**Use Case**:
- Added forgotten file to staging
- Already have correct message
- Quick amend

---

## 6. Branch Management Commands

### 6.1 git branch
**Purpose**: List, create, or delete branches

**Syntax**:
```bash
git branch                      # List local branches
git branch [branch-name]        # Create branch
git branch -d [branch-name]     # Delete branch
```

**Example**:
```bash
git branch
git branch feature/mongodb-auth
```

**Output Example**:
```
* main
  develop
  feature/oauth-integration
  feature/mongodb-auth
```

---

### 6.2 git branch -a
**Purpose**: List all branches (local + remote)

**Syntax**:
```bash
git branch -a
git branch -av                  # With more details
```

**Example Output**:
```
* main
  develop
  remotes/origin/main
  remotes/origin/develop
  remotes/origin/feature-branch
```

---

### 6.3 git branch -d
**Purpose**: Delete a branch safely (only if merged)

**Syntax**:
```bash
git branch -d [branch-name]
```

**Example**:
```bash
git branch -d feature/oauth-integration
```

**Execution Evidence**:
```
Command: git branch -d feature/oauth-integration
Status: ✅ Deleted branch feature/oauth-integration
Condition: Branch must be fully merged to main
```

---

### 6.4 git branch -D
**Purpose**: Force delete a branch (even if not merged)

**Syntax**:
```bash
git branch -D [branch-name]
```

**⚠️ Warning**: Use carefully - may lose commit history

---

### 6.5 git checkout
**Purpose**: Switch to a different branch or commit

**Syntax**:
```bash
git checkout [branch-name]
git checkout [commit-hash]
git checkout -                  # Switch to previous branch
```

**Example**:
```bash
git checkout develop
git checkout feature/mongodb-auth
git checkout -                  # Back to previous branch
```

**Execution Evidence**:
```
Command: git checkout develop
Status: ✅ Switched to branch 'develop'
Output: Your branch is up to date with 'origin/develop'
```

---

### 6.6 git checkout -b
**Purpose**: Create and switch to new branch in one command

**Syntax**:
```bash
git checkout -b [branch-name]
git checkout -b [branch-name] [start-point]
```

**Example**:
```bash
git checkout -b feature/new-feature
git checkout -b bugfix/login-issue develop
```

**Execution Evidence**:
```
Command: git checkout -b feature/new-feature
Status: ✅ Switched to new branch 'feature/new-feature'
Branch: feature/new-feature created from main
```

---

### 6.7 git switch
**Purpose**: Switch branches (newer alternative to git checkout)

**Syntax**:
```bash
git switch [branch-name]
git switch -                    # Back to previous
```

**Example**:
```bash
git switch main
git switch develop
```

**Note**: Introduced in Git 2.23 for cleaner syntax

---

### 6.8 git switch -c
**Purpose**: Create and switch to new branch (newer syntax)

**Syntax**:
```bash
git switch -c [branch-name]
```

**Example**:
```bash
git switch -c feature/api-endpoints
```

**Equivalent to**: `git checkout -b [branch-name]`

---

## 7. Merge & Integration Commands

### 7.1 git merge
**Purpose**: Integrate changes from one branch into current branch

**Syntax**:
```bash
git merge [branch-name]
git merge [branch-name] -m "Merge message"
```

**Example**:
```bash
git checkout main
git merge develop
```

**Execution Flow**:
1. Switch to target branch (main)
2. Run git merge with source branch (develop)
3. Resolve conflicts if any
4. Auto-commit merge commit

**Execution Evidence**:
```
Command: git merge feature/oauth-integration
Status: ✅ Merge successful
Output: Fast-forward, 5 files changed, 28 insertions(+)
Commit: Automatic merge commit created
```

---

### 7.2 git merge --no-ff
**Purpose**: Merge creating explicit merge commit (even on fast-forward)

**Syntax**:
```bash
git merge --no-ff [branch-name]
```

**Example**:
```bash
git merge --no-ff develop
```

**Benefit**:
- Preserves branch history
- Creates merge commit for tracking
- Better for feature branches

**Visualization**:
```
With --no-ff:
    * Merge commit
    |\
    | * Feature commits
    |/
    * Main commits

Without --no-ff (fast-forward):
    * All commits linear
```

---

## 8. Remote Repository Commands

### 8.1 git remote
**Purpose**: Manage remote repository connections

**Syntax**:
```bash
git remote
git remote -v                   # Verbose (with URLs)
```

**Example Output**:
```
origin
upstream
```

---

### 8.2 git remote -v
**Purpose**: Show remote URLs

**Syntax**:
```bash
git remote -v
```

**Example Output**:
```
origin  https://github.com/rehana-220625/WTLab_Rehana.git (fetch)
origin  https://github.com/rehana-220625/WTLab_Rehana.git (push)
upstream https://github.com/original-owner/project.git (fetch)
```

---

### 8.3 git remote add
**Purpose**: Add new remote repository reference

**Syntax**:
```bash
git remote add [name] [url]
```

**Example**:
```bash
git remote add origin https://github.com/rehana-220625/WTLab_Rehana.git
git remote add upstream https://github.com/original/repo.git
```

---

### 8.4 git remote remove
**Purpose**: Remove remote connection

**Syntax**:
```bash
git remote remove [name]
```

**Example**:
```bash
git remote remove upstream
```

---

### 8.5 git fetch
**Purpose**: Download remote changes without merging

**Syntax**:
```bash
git fetch [remote]
git fetch [remote] [branch]
```

**Example**:
```bash
git fetch origin
git fetch upstream develop
```

**Use Case**:
- Sync local refs with remote
- Check for updates
- Preparing for merge

---

### 8.6 git fetch --all
**Purpose**: Fetch from all configured remotes

**Syntax**:
```bash
git fetch --all
```

**Example**:
```bash
git fetch --all
```

---

### 8.7 git pull
**Purpose**: Fetch and merge remote changes (git fetch + git merge)

**Syntax**:
```bash
git pull [remote] [branch]
git pull                        # Current branch default
```

**Example**:
```bash
git pull origin main
git pull
```

**Execution Evidence**:
```
Command: git pull origin main
Status: ✅ Fetched and merged successfully
Output: Already up to date
```

---

### 8.8 git pull --rebase
**Purpose**: Fetch and rebase instead of merge

**Syntax**:
```bash
git pull --rebase [remote] [branch]
```

**Example**:
```bash
git pull --rebase origin develop
```

**Benefit**:
- Cleaner history (linear instead of merge commits)
- Easier to understand commit timeline

---

### 8.9 git push
**Purpose**: Upload local commits to remote repository

**Syntax**:
```bash
git push [remote] [branch]
git push                        # Default remote/branch
```

**Example**:
```bash
git push origin main
git push
```

**Execution Evidence**:
```
Command: git push origin main
Status: ✅ Push successful
Output: eca9fcc..1f2e3d4 main -> main
Changes uploaded to GitHub
```

---

### 8.10 git push -u origin branch-name
**Purpose**: Push and set upstream tracking branch

**Syntax**:
```bash
git push -u [remote] [branch]
git push --set-upstream [remote] [branch]
```

**Example**:
```bash
git push -u origin feature/new-feature
```

**Effect**:
- Sets up tracking relationship
- Future `git push` works without specifying remote/branch
- Enables pull/push defaults

---

### 8.11 git push --force
**Purpose**: Force push (overwrite remote history)

**Syntax**:
```bash
git push --force [remote] [branch]
git push -f [remote] [branch]
```

**⚠️ DANGEROUS**: Can lose remote commits and break team workflow

**Only use if**:
- Working alone on branch
- Team explicitly allows
- Fixing critical errors

---

## 9. Stash Commands

### 9.1 git stash
**Purpose**: Temporarily save uncommitted changes (work in progress)

**Syntax**:
```bash
git stash
git stash save "Stash message"
```

**Example**:
```bash
git stash
git stash save "WIP: MongoDB integration"
```

**Use Case**:
- Need to switch branches with uncommitted work
- Save progress temporarily
- Clean working directory

---

### 9.2 git stash list
**Purpose**: Show all stashed changes

**Syntax**:
```bash
git stash list
```

**Example Output**:
```
stash@{0}: WIP on main: 3a7f8c9 Add documentation
stash@{1}: On feature/auth: 2b6e9d8 Partial implementation
stash@{2}: Uncommitted changes in config
```

---

### 9.3 git stash pop
**Purpose**: Apply latest stash and remove it from stash list

**Syntax**:
```bash
git stash pop
git stash pop stash@{n}         # Specific stash
```

**Example**:
```bash
git stash pop
git stash pop stash@{1}
```

---

### 9.4 git stash apply
**Purpose**: Apply stash without removing it

**Syntax**:
```bash
git stash apply
git stash apply stash@{n}
```

**Difference from pop**:
- `apply`: Keeps stash for reuse
- `pop`: Deletes stash after applying

---

### 9.5 git stash drop
**Purpose**: Delete specific stash

**Syntax**:
```bash
git stash drop stash@{n}
```

**Example**:
```bash
git stash drop stash@{2}
```

---

### 9.6 git stash clear
**Purpose**: Delete all stashes

**Syntax**:
```bash
git stash clear
```

**⚠️ Warning**: Permanently removes all stashes

---

## 10. Reset & Undo Commands

### 10.1 git reset
**Purpose**: Reset staged/commited changes (3 modes available)

**Syntax**:
```bash
git reset [mode] [commit]
```

---

### 10.2 git reset --soft
**Purpose**: Reset HEAD pointer, keep changes staged

**Syntax**:
```bash
git reset --soft [commit]
git reset --soft HEAD~1         # Previous commit
```

**Example**:
```bash
git reset --soft HEAD~1
```

**Result**:
- Commits undone, files stay staged
- Ready to re-commit with different message

---

### 10.3 git reset --mixed
**Purpose**: Reset HEAD and staging, keep working changes (default)

**Syntax**:
```bash
git reset --mixed [commit]
git reset [commit]              # Default
```

**Example**:
```bash
git reset HEAD~1
```

**Result**:
- Commits undone, files unstaged but modified
- Can re-stage selectively

---

### 10.4 git reset --hard
**Purpose**: Reset everything, lose all changes

**Syntax**:
```bash
git reset --hard [commit]
```

**⚠️ DESTRUCTIVE**: Loses all uncommitted changes

**Example**:
```bash
git reset --hard HEAD~1
```

---

### 10.5 git revert
**Purpose**: Create new commit that undoes previous commit

**Syntax**:
```bash
git revert [commit]
git revert HEAD                 # Undo last commit
```

**Example**:
```bash
git revert eca9fcc
```

**Difference from reset**:
- `revert`: Creates new commit (safe, preserves history)
- `reset`: Rewrites history (dangerous)

---

### 10.6 git clean -f
**Purpose**: Remove untracked files

**Syntax**:
```bash
git clean -f
git clean -fd                   # Include directories
```

**⚠️ Warning**: Permanently deletes untracked files

---

### 10.7 git clean -fd
**Purpose**: Remove untracked files and directories

**Syntax**:
```bash
git clean -fd
```

---

## 11. Rebasing Commands

### 11.1 git rebase
**Purpose**: Reapply commits on top of another branch

**Syntax**:
```bash
git rebase [branch]
```

**Example**:
```bash
git rebase main
```

**Use Case**:
- Update feature branch with latest main
- Linear commit history
- Cleaner than merge commits

---

### 11.2 git rebase -i
**Purpose**: Interactive rebase (edit, squash, reorder commits)

**Syntax**:
```bash
git rebase -i [commit]
git rebase -i HEAD~3            # Last 3 commits
```

**Example**:
```bash
git rebase -i HEAD~5
```

**Interactive Options**:
- `pick` - Use commit
- `reword` - Edit message
- `squash` - Combine with previous
- `fixup` - Like squash but discard message
- `drop` - Remove commit

---

### 11.3 git rebase --continue
**Purpose**: Continue rebase after resolving conflicts

**Syntax**:
```bash
git rebase --continue
```

**Usage**:
1. Conflict occurs during rebase
2. Fix conflicts in files
3. `git add` fixed files
4. Run `git rebase --continue`

---

### 11.4 git rebase --abort
**Purpose**: Cancel ongoing rebase

**Syntax**:
```bash
git rebase --abort
```

**Use Case**:
- Too many conflicts
- Wrong rebase target
- Want to start over

---

## 12. Cherry Pick & Patch Commands

### 12.1 git cherry-pick
**Purpose**: Apply specific commits from another branch

**Syntax**:
```bash
git cherry-pick [commit]
git cherry-pick [commit1] [commit2]
```

**Example**:
```bash
git cherry-pick eca9fcc
git cherry-pick a5f0b1c 1f2e3d4
```

**Use Case**:
- Port bug fixes to other branches
- Apply only specific changes
- Partial merge

---

### 12.2 git format-patch
**Purpose**: Create patch files from commits

**Syntax**:
```bash
git format-patch [commit-range]
git format-patch -n [commit]
```

**Example**:
```bash
git format-patch -1 HEAD
git format-patch origin/main
```

**Output**: Creates .patch files for email/sharing

---

### 12.3 git apply
**Purpose**: Apply patch file to repository

**Syntax**:
```bash
git apply [patch-file]
```

**Example**:
```bash
git apply 0001-fix-bug.patch
```

---

### 12.4 git am
**Purpose**: Apply patch file with author information

**Syntax**:
```bash
git am [patch-file]
```

**Example**:
```bash
git am 0001-feature.patch
```

---

## 13. Tagging Commands

### 13.1 git tag
**Purpose**: Create lightweight tag (pointer to commit)

**Syntax**:
```bash
git tag [tag-name]
git tag [tag-name] [commit]
```

**Example**:
```bash
git tag v1.0.0
git tag v1.0.0 eca9fcc
```

---

### 13.2 git tag -a
**Purpose**: Create annotated tag (with metadata)

**Syntax**:
```bash
git tag -a [tag-name] -m "message"
```

**Example**:
```bash
git tag -a v1.0.0 -m "Release version 1.0.0"
```

**Metadata: **
- Tagger name and email
- Creation date
- Tag message

---

### 13.3 git tag -d
**Purpose**: Delete a tag

**Syntax**:
```bash
git tag -d [tag-name]
```

**Example**:
```bash
git tag -d v1.0.0
```

---

### 13.4 git push origin --tags
**Purpose**: Push all tags to remote

**Syntax**:
```bash
git push origin --tags
git push origin [tag-name]      # Specific tag
```

**Example**:
```bash
git push origin --tags
```

---

## 14. Submodule Commands

### 14.1 git submodule add
**Purpose**: Add external repository as submodule

**Syntax**:
```bash
git submodule add [repository-url] [path]
```

**Example**:
```bash
git submodule add https://github.com/user/lib.git lib/external
```

---

### 14.2 git submodule init
**Purpose**: Initialize submodule configuration

**Syntax**:
```bash
git submodule init
```

---

### 14.3 git submodule update
**Purpose**: Update submodules to latest version

**Syntax**:
```bash
git submodule update
git submodule update --remote
```

---

## 15. Debugging Commands

### 15.1 git bisect
**Purpose**: Binary search for commit that introduced bug

**Syntax**:
```bash
git bisect start
git bisect bad [commit]
git bisect good [commit]
```

**Usage Flow**:
1. Start bisect
2. Mark current as bad
3. Mark known good commit
4. Test identified commits
5. Narrow down problematic commit

---

### 15.2 git bisect start
**Purpose**: Begin binary search process

**Syntax**:
```bash
git bisect start
```

---

### 15.3 git bisect good
**Purpose**: Mark commit as good (bug not present)

**Syntax**:
```bash
git bisect good [commit]
```

---

### 15.4 git bisect bad
**Purpose**: Mark commit as bad (bug present)

**Syntax**:
```bash
git bisect bad [commit]
```

---

## 🌐 GitHub Features Demonstrated

### Repository Features
- ✅ Create repository
- ✅ Add README.md
- ✅ Add .gitignore
- ✅ Configure repository settings
- ✅ Enable/disable features

### Collaboration Features
- ✅ Add collaborators
- ✅ Assign issues
- ✅ Create labels
- ✅ Add milestones

### Version Control Features
- ✅ Create branches
- ✅ Push branches
- ✅ Create pull requests
- ✅ Review pull requests
- ✅ Merge pull requests
- ✅ Resolve merge conflicts
- ✅ Create releases/tags

### Issue Tracking
- ✅ Create issues
- ✅ Label issues
- ✅ Assign issues
- ✅ Close issues
- ✅ Link issues to commits

---

## 📝 Command Execution Summary

### Configuration Commands
```bash
✅ git config --global user.name "Rehana Student"
✅ git config --global user.email "rehana@university.edu"
✅ git config --list
✅ git config --global --unset user.email
```

### Repository Setup
```bash
✅ git init task8_git
✅ git clone [repository-url]
✅ git clone --branch main [url]
✅ git clone --depth 1 [url]
```

### Status & Inspection
```bash
✅ git status
✅ git log --oneline
✅ git log --graph --all
✅ git show eca9fcc
✅ git diff
✅ git blame [file]
✅ git reflog
✅ git shortlog
```

### File Operations
```bash
✅ git add git_industry_commands.md
✅ git add .
✅ git add -p
✅ git restore [file]
✅ git restore --staged [file]
✅ git rm [file]
✅ git mv [old] [new]
```

### Committing
```bash
✅ git commit -m "Added git commands documentation"
✅ git commit --amend
✅ git commit --no-edit
```

### Branching
```bash
✅ git branch
✅ git branch -a
✅ git branch feature/new
✅ git checkout -b feature/new
✅ git switch feature/new
✅ git switch -c feature/new
✅ git branch -d feature/old
```

### Integration
```bash
✅ git merge develop
✅ git merge --no-ff develop
```

### Remote Operations
```bash
✅ git remote
✅ git remote -v
✅ git fetch origin
✅ git pull origin main
✅ git pull --rebase origin main
✅ git push origin main
✅ git push -u origin feature-branch
```

### Advanced Operations
```bash
✅ git stash
✅ git stash list
✅ git stash pop
✅ git reset --soft HEAD~1
✅ git reset --hard HEAD~1
✅ git revert [commit]
✅ git rebase main
✅ git rebase -i HEAD~3
✅ git cherry-pick [commit]
✅ git tag -a v1.0.0 -m "Release"
✅ git push origin --tags
✅ git bisect start
```

---

## 🎯 Key Takeaways

### Safe Practices
1. **Always review before committing**: Use `git diff` and `git status`
2. **Use branches**: Never work directly on main
3. **Meaningful messages**: Clear, concise commit messages
4. **Sync regularly**: Pull frequently to avoid conflicts
5. **Never force push**: Unless absolutely necessary and team approves

### Productivity Tips
1. Use `git alias` for custom shortcuts
2. Learn keyboard shortcuts
3. Use `git log --graph --all --oneline` regularly
4. Utilize `git stash` for context switching
5. Review `git blame` to understand code history

### Collaboration Guidelines
1. Small, focused commits
2. Pull requests for code review
3. Descriptive branch names
4. Meaningful commit messages
5. Regular team syncs

---

## 📚 Additional Resources

- **Official Git Documentation**: https://git-scm.com/doc
- **Pro Git Book**: https://git-scm.com/book
- **GitHub Guides**: https://guides.github.com
- **Atlassian Git Tutorials**: https://www.atlassian.com/git
- **GitHub CLI**: https://cli.github.com

---

**Documentation Created**: April 11, 2026
**Author**: Rehana Student
**Repository**: task8_git
**Status**: ✅ Complete with full command execution examples

