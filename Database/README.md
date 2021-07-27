All the data stored in this file with this tables.

## Installation

You can import the sql file with using *phpmyadmin*. 
> Table Name : notex

There are two table: 
## Users Table

  - users
    * userId
    * username
    * password
    * email

### Admin Account
Admin account informations is shown at below. There is no any privilege to Admin. It can also be thought of as a test user.
    
|   | userId   | username  | password |   email  |
| --|:--------:| ---------:| --------:| --------:|
| 1 | 1        | kkrgzz    | 123456   | ex@ex.com|

## Notes Table

It contains the data of the notes that user saved. We can get the spesific note of a user with using *noteOwner* column.
  - notes
    * noteId
    * noteOwner
    * noteTitle
    * noteContent
    * noteDate

