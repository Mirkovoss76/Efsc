# Eppendorf Full Stack Challenge

## What it does
can read entries from the database and visualises them
  - allows editing existing entries
  - is able to add new entries
  - is able to delete existing entries
## Installation
1. Create a directory and copy the code
2. Upload by FTP
3. Go with SSH into the root directory of the project on out server
4. composer install

## Configuration
After installing change the Database Data:

    # app/.env
    # For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
    # Configure your db driver and server_version in config/packages/doctrine.yaml
    DATABASE_URL=mysql://root:root@127.0.0.1:8889/eppendorf
   
   In the Console: php bin/console doctrine:migrations:migrate
  and your database ist up to date.
   
## Configuration Datatables
1. Headline
2. Data from Database
Here you can edit the Datatables:
 

    # app/src/Controller/ProductindexController
  
          
            $table = $this->datatableFactory->create([])
                ->add('location', TextColumn::class, ['label' => 'location', 'searchable' => true])
                ->add('type', TextColumn::class, ['label' => 'Type', 'searchable' => true])
                ->add('device_health', TextColumn::class, ['label' => 'Device health', 'searchable' => true])
                ->add('last_used', DateTimeColumn::class, ['label' => 'last_used', 'searchable' => true])
                ->add('price', TextColumn::class, ['label' => 'price', 'searchable' => true])
                ->add('color', HtmlcolorColumn::class, [

                    'label' => 'color',

                ])
                ->add('id', HtmlbuttonColumn::class, [
                    'className' => 'buttons ',
                    'label' => 'actions',


                ])
                ->createAdapter(ORMAdapter::class, [
                    'entity' => Products::class,
                ])
                ->handleRequest($request);
        }
