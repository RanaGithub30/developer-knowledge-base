# Top Git Interview Questions & Answers

This version is written in a more natural interview style so you can answer confidently in interviews.

## Table of Contents

1. What is Git?
2. What is the difference between Git and GitHub?
3. What is a repository?
4. What is the difference between Git and SVN?
5. What are the three states in Git?
6. What is the Git workflow?
7. What is the difference between `git pull` and `git fetch`?
8. What is the difference between `git merge` and `git rebase`?
9. What is the difference between `git reset` and `git revert`?
10. What is the difference between `git checkout` and `git switch`?
11. What is the staging area?
12. How do you initialize a Git repository?
13. How do you clone a repository?
14. How do you check the status of your repository?
15. How do you stage changes?
16. How do you commit changes?
17. How do you view commit history?
18. What is a branch?
19. How do you create a branch?
20. How do you switch branches?
21. How do you merge branches?
22. What are merge conflicts?
23. How do you resolve merge conflicts?
24. What is HEAD in Git?
25. What is a detached HEAD?
26. What is Git Stash?
27. How do you stash changes?
28. How do you apply or pop a stash?
29. What is `.gitignore`?
30. What are Git tags?
31. What is Cherry-picking?
32. What is Interactive Rebase?
33. What are Git Hooks?
34. What is Squashing commits?
35. What is Fast-forward merge?
36. What is Origin?
37. What is Upstream?
38. How do you undo the last commit?
39. How do you delete a branch?
40. Common Git Commands Cheat Sheet

---

# 1. What is Git?

# Answer:

Git is a distributed version control system that helps developers track changes in source code over time. It allows multiple people to work on the same project safely, maintain a full history of changes, and collaborate through branches and commits.

Example:

```bash
git init
git add .
git commit -m "Initial commit"
```

---

# 2. What is the difference between Git and GitHub?

# Answer:

Git is the version control tool that runs locally on your machine and tracks changes in files. GitHub is a web-based platform that hosts Git repositories, making collaboration easier through pull requests, code review, and remote access.

---

# 3. What is a repository?

# Answer:

A repository, or repo, is a storage location for a project that contains its files, history, branches, and tags. It acts as the central place where all changes are recorded and managed.

---

# 4. What is the difference between Git and SVN?

# Answer:

Git is distributed, which means each developer has a full copy of the repository and can work offline. SVN is centralized, so it depends more heavily on a central server and is generally less flexible for branching and collaboration.

---

# 5. What are the three states in Git?

# Answer:

Git tracks files in three states: modified, staged, and committed. A file is modified when changes are made, staged when it is prepared for the next commit, and committed when the snapshot is saved in the repository.

---

# 6. What is the Git workflow?

# Answer:

The usual Git workflow is: modify files, check status, stage the changes, commit them, and then push them to a remote repository. This process keeps the project history clean and organized.

```text
Edit files -> git status -> git add -> git commit -> git push
```

---

# 7. What is the difference between `git pull` and `git fetch`?

# Answer:

`git fetch` downloads the latest changes from the remote repository but does not merge them into your current branch. 

`git pull` does both: it fetches the changes and then merges them into your working branch.

```bash
git fetch origin
git pull origin main
```

---

# 8. What is the difference between `git merge` and `git rebase`?

# Answer:

`git merge` combines two branches while preserving the branch history, which is usually safer for shared branches. 

`git rebase` moves commits from one branch onto another to create a cleaner, linear history, but it rewrites commit history and should be used carefully.

---

# 9. What is the difference between `git reset` and `git revert`?

# Answer:

`git reset` changes the current commit pointer and is typically used to undo changes locally. 

`git revert` creates a new commit that undoes the effects of a previous commit, which makes it safer for shared or public branches.

```bash
git reset --soft HEAD~1
git revert HEAD
```

---

# 10. What is the difference between `git checkout` and `git switch`?

# Answer:

`git checkout` is an older command that can switch branches or restore files. 

`git switch` is a newer and more focused command designed specifically for switching branches, making it easier and less error-prone.

```bash
git checkout feature-login
git switch feature-login
```

---

# 11. What is the staging area?

# Answer:

The staging area is an intermediate step between your working directory and the Git repository. It lets you review and group changes before committing them, which is useful for creating clean and meaningful commits.

---

# 12. How do you initialize a Git repository?

# Answer:

we initialize a Git repository with `git init` in the project folder. This creates a hidden `.git` directory that starts tracking the project’s history.

```bash
git init
```

---

# 13. How do you clone a repository?

# Answer:

we use `git clone` to create a local copy of a remote repository. It downloads the project files and the full commit history so we can start working immediately.

```bash
git clone https://github.com/user/project.git
```

---

# 14. How do you check the status of your repository?

# Answer:

we use `git status` to see which files are modified, staged, or untracked and to confirm the current branch. It is one of the first commands we run when we want to understand the state of the repository.

```bash
git status
```

---

# 15. How do you stage changes?

# Answer:

we stage changes using `git add`. This moves the selected changes from the working directory into the staging area so they are ready to be committed.

```bash
git add app.js
git add .
```

---

# 16. How do you commit changes?

# Answer:

we commit changes with `git commit -m "message"` so the changes are saved as a snapshot in the repository history. A good commit message should clearly describe what changed.

```bash
git commit -m "Add login page"
```

---

# 17. How do you view commit history?

# Answer:

we use `git log` to inspect the commit history and understand how the project evolved. For a cleaner view, we often use `git log --oneline` or `git log --graph --oneline --all`.

```bash
git log --oneline
git log --graph --oneline --all
```

---

# 18. What is a branch?

# Answer:

A branch is an independent line of development within a repository. It allows developers to work on features or fixes without affecting the main codebase until the changes are ready to merge.

---

# 19. How do you create a branch?

# Answer:

we create a branch to isolate our work, usually with `git switch -c branch-name` or `git branch branch-name`. This helps keep feature development organized and separate from the main branch.

```bash
git switch -c feature-login
```

---

# 20. How do you switch branches?

# Answer:

we switch branches with `git switch branch-name`. This changes the working directory to that branch so we can continue development there.

```bash
git switch main
```

---

# 21. How do you merge branches?

# Answer:

To merge branches, we switch to the target branch and run `git merge`. This brings the changes from one branch into another, usually the main branch.

```bash
git switch main
git merge feature-login
```

---

# 22. What are merge conflicts?

# Answer:

Merge conflicts happen when Git cannot automatically decide which changes to keep because two branches modified the same lines. In that case, we need to resolve the conflict manually before completing the merge.

---

# 23. How do you resolve merge conflicts?

# Answer:

To resolve a merge conflict, we open the conflicted file, decide which version of the code should remain, remove the conflict markers, and then stage and commit the result. The goal is to leave the file in a correct and consistent state.

```bash
git add .
git commit -m "Resolve merge conflict"
```

---

# 24. What is HEAD in Git?

# Answer:

`HEAD` is a pointer that indicates the current commit your working tree is on. It helps Git know which state of the repository you are currently viewing or editing.

---

# 25. What is a detached HEAD?

# Answer:

A detached HEAD happens when `HEAD` points directly to a specific commit instead of a branch. It is useful for inspecting or testing a commit, but we would normally avoid making changes there unless we intend to create a new branch.

```bash
git checkout <commit-hash>
```

---

# 26. What is Git Stash?

# Answer:

Git stash is used to temporarily save uncommitted work so we can switch branches or work on something else without committing. It is very useful when we need to pause our current changes safely.

---

# 27. How do you stash changes?

# Answer:

we use `git stash` to temporarily store our current changes. If we want to be more descriptive, we can add a message using `git stash push -m`.

```bash
git stash
git stash push -m "WIP login feature"
```

---

# 28. How do you apply or pop a stash?

# Answer:

we can restore stashed work with `git stash apply` or `git stash pop`. The difference is that `pop` applies the stash and removes it from the stash list, while `apply` keeps it there.

```bash
git stash list
git stash apply
git stash pop
```

---

# 29. What is `.gitignore`?

# Answer:

`.gitignore` is a file that tells Git which files or folders to ignore, such as build artifacts, environment files, or dependencies. This keeps the repository clean and avoids committing unnecessary files.

```text
node_modules/
.env
dist/
*.log
```

---

# 30. What are Git tags?

# Answer:

Git tags are used to mark important points in history, such as release versions. They are helpful for identifying specific commits like `v1.0` or `v2.0`.

```bash
git tag v1.0
git tag -a v1.0 -m "Release 1.0"
```

---

# 31. What is Cherry-picking?

# Answer:

Cherry-picking means applying a specific commit from one branch to another. we use it when we want to bring over one particular change without merging the entire branch.

```bash
git cherry-pick <commit-hash>
```

---

# 32. What is Interactive Rebase?

# Answer:

Interactive rebase lets us rewrite and reorganize commit history interactively. It is often used to squash related commits, reorder them, or edit commit messages before sharing changes.

```bash
git rebase -we HEAD~5
```

---

# 33. What are Git Hooks?

# Answer:

Git hooks are scripts that run automatically at certain Git events like commit, push, or merge. They are commonly used to enforce formatting, run tests, or perform validation before changes are accepted.

---

# 34. What is Squashing commits?

# Answer:

Squashing commits means combining multiple small commits into one cleaner commit. This is often done to make the history easier to read and maintain before merging into a main branch.

```bash
git rebase -we
```

---

# 35. What is Fast-forward merge?

# Answer:

A fast-forward merge happens when the target branch has not diverged and the source branch can be simply moved forward. In that case, Git updates the branch pointer without creating a separate merge commit.

---

# 36. What is Origin?

# Answer:

`origin` is the default name given to the remote repository that a local repository tracks. It is commonly used when pushing or pulling changes to GitHub or another remote host.

```bash
git remote -v
```

---

# 37. What is Upstream?

# Answer:

Upstream refers to the remote branch that your local branch is tracking. It is especially useful when working on a forked repository and syncing changes from the original project.

```bash
git push -u origin main
```

---

# 38. How do you undo the last commit?

# Answer:

If we want to undo the last commit but keep the changes, we use `git reset --soft HEAD~1`. If we want to remove both the commit and the changes, we use `git reset --hard HEAD~1`. If the commit has already been pushed, `git revert` is the safer option.

```bash
git reset --soft HEAD~1
git revert HEAD
```

---

# 39. How do you delete a branch?

# Answer:

we delete a local branch with `git branch -d` when it is already merged, and we use `git branch -D` when we want to force deletion. To remove a branch from the remote repository, we use `git push origin --delete branch-name`.

```bash
git branch -d feature-login
git push origin --delete feature-login
```

---

# 40. Common Git Commands Cheat Sheet

| Command | Description |
|----------|-------------|
| `git init` | Initialize a repository |
| `git clone` | Clone a remote repository |
| `git status` | Check working tree status |
| `git add .` | Stage all changes |
| `git commit -m "msg"` | Commit changes |
| `git log --oneline` | View commit history |
| `git branch` | List branches |
| `git switch branch` | Switch branches |
| `git switch -c branch` | Create and switch to a branch |
| `git merge branch` | Merge a branch |
| `git rebase branch` | Rebase onto another branch |
| `git stash` | Temporarily save changes |
| `git stash pop` | Restore and remove a stash |
| `git fetch` | Download remote changes |
| `git pull` | Fetch and merge remote changes |
| `git push` | Push commits to a remote |
| `git remote -v` | View remote repositories |
| `git tag` | List tags |
| `git cherry-pick` | Apply a specific commit |
| `git reset` | Move the current branch pointer |
| `git revert` | Create a new commit that undoes previous changes |
| `git diff` | Show file differences |
| `git blame` | Show line-by-line change history |
| `git reflog` | View recent HEAD movements |

---

# Interview Tips

- Be clear on the difference between `merge`, `rebase`, `reset`, and `revert`.
- Practice explaining branching, staging, and commit flow from memory.
- Be comfortable resolving merge conflicts.
- Know when to use `stash`, `cherry-pick`, and `reflog`.
- Use `git log --graph --oneline --all` to explain history clearly during interviews.