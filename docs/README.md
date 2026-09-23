# MedReach setup + how to apply a patch handoff (for everyone on the team)

Windows only — no Git Bash, no WSL, nothing Linux needed. Just double-click.
Do **Part 1** once, the first time you ever touch the project. Do **Part 2**
every time you get a new dated handoff folder.

## Part 1 — One-time computer setup

Do these in order. This gets the project running in your browser with
nothing installed yet.

### 1. Install XAMPP

Download and install from https://www.apachefriends.org/download.html
(default options are fine — make sure Apache and MySQL are ticked).

Open **XAMPP Control Panel** and click **Start** next to both **Apache**
and **MySQL**. Both rows should turn green. Leave this window open — if
either service is stopped, the site won't load. Start it the same way
every time you sit down to work.

### 2. Install Git for Windows

https://git-scm.com/downloads — this gives you the `git` command. You do
**not** need to use Git Bash for any of this, plain Command Prompt is
enough (installing Git also adds the `git` command to Command Prompt).

### 3. Install the GitHub CLI

https://cli.github.com — lets scripts log you into GitHub automatically
when needed.

### 4. Clone the repo (not directly into htdocs)

Open **Command Prompt** (Start menu → search `cmd`) — not PowerShell, not
Git Bash, plain Command Prompt — and pick a normal folder to keep your
code in, e.g. `Documents\GitHub`:

```bat
cd %USERPROFILE%\Documents
mkdir GitHub
cd GitHub
git clone git@github.com:Med-Reach-UCSC/MedReach.git
```

(If `git@github.com:...` fails because SSH isn't set up, use
`https://github.com/Med-Reach-UCSC/MedReach.git` instead and sign in when
prompted.)

### 5. Symlink the project into htdocs

XAMPP only serves files from `C:\xampp\htdocs`. Instead of cloning there
directly, link it — this keeps your one copy of the code in
`Documents\GitHub` and just makes it *visible* to Apache too.

Open **Command Prompt as Administrator** (Start menu → search `cmd` →
right-click → **Run as administrator**) and run:

```bat
mklink /D "C:\xampp\htdocs\MedReach" "%USERPROFILE%\Documents\GitHub\MedReach"
```

You should now see a `MedReach` shortcut-like folder inside
`C:\xampp\htdocs`.

### 6. Create the database

1. With MySQL running (Part 1.1), open http://localhost/phpmyadmin in your
   browser.
2. Click **Databases** → type `medreach` as the database name → **Create**.
3. Click on the new `medreach` database → **Import** tab → **Choose File**
   → pick `database\medreach.sql` from your cloned repo → **Go**. This
   creates all the tables.

### 7. Configure the database connection

In Command Prompt, in your repo folder:

```bat
copy config\db.php.example config\db.php
```

Open `config\db.php` in any text editor and set it to XAMPP's default
MySQL account (no password by default):

```php
$user = 'root';
$pass = '';
```

`config\db.php` is git-ignored on purpose — never commit it, and never
send it to anyone.

### 8. Check out your own branch

Your branch is your first name — look yourself up in the table under
"Which folder is mine?" below, then swap `<your-branch>` for it:

```bat
cd "%USERPROFILE%\Documents\GitHub\MedReach"
git fetch origin
git checkout <your-branch>
```

### 9. Open it in your browser

http://localhost/MedReach/index.php — if the page loads, you're set up.
If you get a blank page or a database error, check MySQL is running
(Part 1.1) and that `config\db.php` was saved correctly.

You only ever repeat step 1 (starting XAMPP) day to day. Steps 2–8 are
one-time.

## Part 2 — Applying a handoff patch

You'll get a file named `<your-name>.zip` (e.g. `thisuni.zip`) — named
after your own branch. Each dated folder inside it is a batch of work
Tharusha built outside your module and is handing off to you. Every folder
has an `apply.bat` that does the whole job for you: it checks you're
logged into GitHub, fetches/checks out your branch, applies the patch(es),
commits with the right message, and pushes — automatically.

### Where to put the zip

1. Unzip `<your-name>.zip` anywhere (Desktop or Downloads is fine).
   Unzipping it creates a `docs` folder, and inside that a folder with
   your own name, and inside *that*, one or more dated folders — one per
   handoff batch, e.g.:
   ```
   docs\
     <your-name>\
       2026-08-20_17-21\
       2026-08-22_15-30\
   ```
2. Move that whole `docs` folder into your cloned repo, next to
   `index.php` — i.e. so the path reads `...\MedReach\docs\<your-name>\...`.
3. If a `docs` folder is already there from an earlier handoff, **don't
   delete it** — just drag your `<your-name>` folder into the existing
   `docs` folder so the new dated batch sits alongside the old ones.

### Running a handoff

1. Open the dated folder you were told about (`docs\<your-name>\<date>\`)
   in File Explorer.
2. **Double-click `apply.bat`.**
3. A black window opens and runs everything. Read what it prints:
   - Lines starting `==>` are normal progress.
   - Lines starting `!!` are a warning — usually fine, just read it.
   - Lines starting `xx` mean it stopped and is telling you exactly what
     to fix (not logged in, uncommitted changes, etc.). Fix that, then
     double-click `apply.bat` again.
4. When it says "Pushed", press any key to close the window. Check GitHub
   to confirm your branch updated.

If Windows shows a blue "Windows protected your PC" SmartScreen prompt,
click **More info → Run anyway** — this happens for any downloaded script,
not because something is wrong with this one.

Each `apply.bat` already targets your own branch — you don't need to know
or type the branch name yourself.

If this `docs` folder has more than one dated subfolder, apply them
**oldest date first** — later batches build on earlier ones (each
`apply.bat` says so at the top of its `INSTRUCTIONS.md` if it matters).

### What the script won't do

- It won't push over work you haven't committed — it stops and asks you to
  commit your changes first.
- It won't force-apply a patch that doesn't match your current files — it
  stops and tells you to message Tharusha instead of guessing.
- It won't force-merge a branch that's diverged from origin — same idea,
  it stops rather than risk creating a mess.
- It never force-pushes.

If a script stops with an error you don't understand, don't retry it
blindly — send Tharusha the exact message it printed.

### Note on `docs\`

This whole folder is listed in `.gitignore` — nothing in here is ever
committed or pushed. It's just a local drop folder for handing patches
between team members outside of git (that's also why older batches were
sent as `.zip` files — this folder isn't visible on GitHub).
