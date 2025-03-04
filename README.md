## Setting Up the Database

### Step 1: Open your *XAMPP CONTROL PANEL*
### Step 2: Start the *Apache* and *MySQL* Services.
### Step 3: Click the *Admin* for the **MySQL** Service.
### Step 4: After the *phpmyadmin* opens, click the **Import** Tab.
### Step 5: In the **File to import:** tab, click *Choose File* and locate the init.sql file and click **Open**.
### Step 6: Scroll to the bottom and click **Import**.
### Step 7: Double check the databases on the left side if there is a database called **vulnerable_app**
### Step 8: Done.

-------

## Vulnerabilities
### SQLi payload
###### for admin account
#### admin' OR 1=1 --'
###### for customer account
#### customer1' OR 1=1 --'

--------
