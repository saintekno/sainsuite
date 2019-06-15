# Migrations

## What are Migrations?

Migrations are simple files that hold the commands to apply and remove changes to your database. This allows you and your team to easily keep track of changes made for each new module. They may create tables, modify tables or fields, etc. But they are not limited to just changing the schema. You could use them to fix bad data in the database or populate new fields.

While you could make the changes to the database by hand, migrations provide a simple, consistent way for developers to stay on track with each other's changes. It also makes it simple to apply the changes in your development environment to your production environment.

Using migration files also creates a version of your database that can be included in your current code versioning, whether you use git, svn, or another solution. While you might not have your data backed up in the case of a devastating loss, you can at least recreate your database and start over.

Migrations are contained in sequentially numbered files so the system knows the order to apply them or remove them.