# GitHub Secret Leak Response

## Question

A developer accidentally pushed a commit containing a production database password to the GitHub repository.

What steps would you take immediately, and how would you prevent this from happening again?

---

# Answer

## Immediate Steps

### 1. Rotate the Password (Highest Priority)

- Immediately change the production database password.
- Update the application with the new credentials.
- Treat the leaked password as compromised.

### 2. Remove the Secret from Git History

- Remove the commit using tools like **git filter-repo** or **BFG Repo-Cleaner**.
- Force push the cleaned history if necessary.

> **Note:** Simply deleting the latest commit is not enough because the secret remains in Git history.

### 3. Notify the Team

- Inform all developers about the incident.
- Ask them to pull the updated repository history if it was rewritten.

### 4. Check for Unauthorized Access

- Review database and GitHub logs for any suspicious activity.
- Verify whether the leaked credential was used.

---

## Prevention

### Use Environment Variables

- Never store passwords or API keys in the source code.
- Store sensitive values in `.env` files.
- Add `.env` to `.gitignore`.

### Enable Secret Scanning

- Use GitHub Secret Scanning or tools like **GitGuardian** to detect exposed secrets automatically.

### Pre-Commit Hooks

- Use tools like **Git Hooks**, **Gitleaks**, or **git-secrets** to scan commits before they are pushed.

### Least Privilege

- Use database accounts with only the required permissions.
- Avoid using highly privileged credentials in applications.

### Code Reviews

- Make code reviews mandatory before merging.
- Review changes for accidental secrets.

### CI/CD Checks

- Integrate secret scanning into the CI/CD pipeline.
- Reject builds if sensitive information is detected.

---

## Conclusion

The first priority is to **rotate the compromised database password**, then **remove the secret from Git history**, notify the team, and monitor for unauthorized access. To prevent future incidents, use environment variables, enable secret scanning, enforce code reviews, and integrate automated secret detection into the development workflow.