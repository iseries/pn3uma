<p><img src="./.github/logo.png" alt="pn4uma"></p>

pn3uma is a web interface for dirsearch with some extras. This package was developed to get a better overview for scanned directories or files.

> _This tool was tested on Linux **only**. If you're using Windows or Mac you have to adjust some commands in the code yourself._

### Features
- scan for subdomain
- check for open port
- check HTTP header
- create Lists
- review Errors
- review and analyse reports (filter, sort or search)

### Requirements
- [dirsearch](https://github.com/maurosoria/dirsearch) has to be installed on your local machine.
- running a local LAMP
- this app is based on a PHP-Framework - check the [flow requirements](https://flowframework.readthedocs.io/en/stable/TheDefinitiveGuide/PartII/Requirements.html).

### Installation
#### 1. Install dirsearch
See: https://github.com/maurosoria/dirsearch#installation--usage

#### 2. Install pn3uma

Clone the project:
```Shell
git clone git@github.com:iseries/pn3uma.git pn3uma
```

Go into the created folder with `cd pn3uma` and install the framework with all necessary dependencies via `composer install`

### Developer notes
If you're interested in contributing to pn3uma you have to install tailwind in the project's root folder.

#### Install tailwind
```Shell
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init
```

Anyway, feel free and raise issues or pull requests.
