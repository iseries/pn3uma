<p><img src="./.github/logo.png" alt="pn4uma"></p>

⚠️ **This package is under development.** ⚠️

pn3uma is a web interface for dirsearch with some extras. This package was developed to get a better overview for scanned directories or files.

> _This tool was tested on Linux **only**. If you're using Windows or Mac you may have to adjust some commands in the code yourself._

### Overview
- [Features](#Features)
- [Requirements](#Requirements)
- [Installation](#Installation)
  - [Install dirsearch](#Install-dirsearch)
  - [Install pn3uma](#Install-pn3uma)
  - [Settings](#Settings)
- [Developer notes](#Developer-notes)
  - [Install tailwind](#Install-tailwind)
  - [Build tailwind css](#Build-tailwind-css)
- [Contribution](#Contribution)

### Features
- scan for subdomain
- check for open port
- check HTTP header
- create lists
- review errors
- review and analyse reports (filter, sort or search)

### Requirements
- [dirsearch](https://github.com/maurosoria/dirsearch) has to be installed on your local machine.
- running a local LAMP
- composer
- pn3uma is based on a PHP-Framework - check the [flow requirements](https://flowframework.readthedocs.io/en/stable/TheDefinitiveGuide/PartII/Requirements.html).

### Installation
#### Install dirsearch
See: https://github.com/maurosoria/dirsearch#installation--usage

#### Install pn3uma
Clone the project:
```Shell
git clone git@github.com:iseries/pn3uma.git pn3uma
```
Go into the created folder with `cd pn3uma` and install the framework with all necessary dependencies via `composer install`

#### Settings
If you want to have a look in pn3uma settings you can find them in `DistributionPackages/Pn3uma.App/Configuration/Settings.yaml`

### Developer notes
If you're interested in developing pn3uma you have to install tailwind in the project's root folder.

#### Install tailwind
```Shell
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init
npm run build
```

#### Build tailwind css
```Shell
npm run build
```

### Contribution
Anyway, feel free and raise issues or pull requests.
