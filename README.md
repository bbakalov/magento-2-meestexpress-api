# MeestExpress API communication

It's extension to communicate with [MeestExpress API v3.0](https://wiki.meest-group.com/api/en/v3.0/openAPI#/)

## Functionality

- Authenticate in MeestExpress system
- Save token for future request
- Use all endpoints of MeestExpress API

## Compatibility

- Magento 2.1, 2.2, 2.3

## 1. How to install MeestExpress API

## ✓ Install MeestExpress API via composer (recommend)
Run the following command in Magento 2 root folder:

```
composer require bdn/magento-2-meestexpress-api
php bin/magento setup:upgrade
```

### ✓ Install ready-to-paste package

- Download the latest version from [Github](https://github.com/bbakalov/magento-2-meestexpress-api/archive/master.zip)
- Unzip it to your project. Folder: **app/code/Bdn/MeestExpress**
- Run the following command in Magento 2 root folder:

```
php bin/magento setup:upgrade
```

## 2. User guide
Login into Magento Admin Panel
### General Configuration

#### Insert your MeestExpress credentials
Go to `Admin Panel > Stores > Configuration > Services > MeestExpress`