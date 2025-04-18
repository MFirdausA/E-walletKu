<p align="center"><a href="ewalletku.my.id" target="_blank"><img src="https://github.com/MFirdausA/E-walletKu/blob/feat/development-local/public/img/app-logo.png?raw=true" width="400" alt="E-Walletku Logo"></a></p>

# 📱 E-WalletKu


E-WalletKu is simple and efeciently Finance managament that helps user track their income and expense. E-WalletKu Design for web mobile and for personal Finance. E-WalletKu have complete feature like recording income, expense, planned payment and visualize your transacsion/recording report in chart by categorize. 


## ✨ Key Features

- Record transaction income and expense
- Planned payment
- Report transaction visualize chart by categoriez
- Simple and easy to use


## Installation

Install E-Walletku with npm

```bash
  cd your directory
  git remote https://github.com/MFirdausA/E-walletKu.git
```
Copy and rename example.env to .env

```bash
  example.env 
  copy
  paste to
  .env
```
Run migration
```bash
  make database

  php artisan make:migration

  php artisan db:seed userTableSeeders
  php artisan db:seed categoriesSeeders
  php artisan db:seed LoanTypesSeeders
  php artisan db:seed RepeatTypesSeeders
  php artisan db:seed StatusesSeeders
  php artisan db:seed TagSeeders
  php artisan db:seed TransactionSeeders
  php artisan db:seed WalletsSeeders
```
File Storage
```bash
  php artisan storage:link 
```
## Tech Stack

**Client:** PHP, Laravel, TailwindCSS, Filament , Dom PDF

**Database:** Laragon , Mysql

**Server:** Ubuntu 24.04, Nginx, PHP 8.4, MySQL, Nginx/Apache , DbEaver 




## Demo

ewalletku.my.id

