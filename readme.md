## Install
```bash
bin/console make:migration
bin/console doctrine:migrations:migrate
```
## Load LOCODE CSV
Place *.zip file in to 
```directory
app_resources/locode
```
You can change resource dir in .env file
```dotenv
APP_RESOURCE_LOCODES='/app_resources/locode/'
```

To load LOCODEs please run command
```bash
bin/console app:locode:load
```

## Endpoint
To check available endpoints and its functionality 
open url
```url
{server_address}:{port}/api
```
