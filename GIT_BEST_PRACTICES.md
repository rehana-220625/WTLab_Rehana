# Git Best Practices Guide

## Code Organization Standards

### Commit Message Guidelines
- **First line**: Summary (imperative mood, 50 chars max)
- **Body**: Detailed explanation (wrap at 72 chars)
- **Footer**: References (Fixes #123, Closes #456)

### Branch Naming Convention
- `main` - Production ready
- `develop` - Development integration
- `feature/feature-name` - New features
- `bugfix/bug-name` - Bug fixes
- `hotfix/issue-name` - Critical fixes
- `release/version-number` - Release preparation

### Pull Request Workflow
1. Create feature branch from develop
2. Push commits regularly
3. Submit PR with description
4. Request code review
5. Address review comments
6. Merge when approved
7. Delete feature branch

## Code Review Checklist

- [ ] Code follows project style guide
- [ ] Tests added/updated
- [ ] Documentation updated
- [ ] No debugging code left
- [ ] Performance impact considered
- [ ] Security implications reviewed
- [ ] Backward compatibility maintained

## Common Git Workflows

### Feature Branch Workflow
```bash
git checkout -b feature/new-feature develop
# Make changes
git add .
git commit -m "Add new feature"
git push -u origin feature/new-feature
# Create pull request
```

### Gitflow Workflow
```bash
# Create release branch
git checkout -b release/1.0.0 develop

# Tag release
git tag -a v1.0.0 -m "Version 1.0.0"

# Hotfix process
git checkout -b hotfix/critical-bug main
# Fix and commit
git tag -a v1.0.1 -m "Version 1.0.1"
```

### Trunk-Based Development
- Main branch is always deployable
- Short-lived feature branches
- Daily merges to main
- Feature flags for incomplete work
- CI/CD integration

## Conflict Resolution Strategy

### Before Conflicts Occur
1. Pull latest changes frequently
2. Keep branches short-lived
3. Communicate with team
4. Small, focused commits

### When Conflicts Occur
1. `git pull --rebase` to see conflicts
2. Open files and locate conflict markers
3. Choose correct version
4. Remove conflict markers
5. `git add` resolved files
6. `git rebase --continue`

### Merge Conflict Markers
```
<<<<<<< HEAD
Your changes
=======
Their changes
>>>>>>> branch-name
```

## Performance Optimization

### Large Repository Management
- Use `git clone --depth 1` for initial clone
- Use `git sparse-checkout` for partial clone
- Archive old branches regularly
- Use `.gitignore` to exclude large files

### Repository Maintenance
```bash
# Clean up local branches
git branch -d merged-branch

# Garbage collection
git gc --aggressive

# Prune remote tracking branches
git fetch -p

# Find large files
git rev-list --all --objects | \
  sort -k2 | \
  tail -20
```

## Security Best Practices

### Protecting Sensitive Data
- Never commit `.env` files
- Use environment variables
- Review commits before pushing
- Use `git secrets` to prevent accidental commits
- Rotate credentials if exposed

### GPG Signing
```bash
# Sign commits
git commit -S -m "commit message"

# Verify signatures
git log --show-signature

# Configure signing
git config --global user.signingKey YOUR_GPG_KEY
git config --global commit.gpgsign true
```

## Disaster Recovery

### Lost Commits
```bash
# Find in reflog
git reflog

# Recover
git cherry-pick COMMIT_HASH
```

### Accidental Hard Reset
```bash
# Check reflog
git reflog

# Restore to previous state
git reset --hard PREVIOUS_HASH
```

### Lost Stash
```bash
# Find in reflog
git reflog show stash

# Recover
git stash apply HASH
```

## Team Collaboration Best Practices

1. **Regular Communication**: Daily standups, async updates
2. **Code Review**: Peer review before merge
3. **Documentation**: Keep README and guides updated
4. **Version Control**: Semantic versioning for releases
5. **Continuous Integration**: Automated tests on every push
6. **Issue Tracking**: Link commits to issues
7. **Release Notes**: Document changes in each version

## Advanced Git Techniques

### Squashing Commits
```bash
# Squash last 3 commits
git rebase -i HEAD~3
# Change 'pick' to 'squash' for commits to combine
```

### Cherry-Picking Commits
```bash
# Apply specific commit from another branch
git cherry-pick COMMIT_HASH
```

### Bisecting to Find Bugs
```bash
git bisect start
git bisect bad HEAD
git bisect good v1.0.0
# Test and mark commits as good/bad
```

### Creating Patches
```bash
# Create patch file
git format-patch -1 HEAD

# Apply patch
git apply patch-file.patch
```

---

**Last Updated**: April 11, 2026
**Version**: 1.0.0
**Status**: Complete

