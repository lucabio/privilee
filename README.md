# Privilee Challege

Privilee Challenge repo it's done to implement the Full Stack Developer Challenge whose directive are indicated in the following document :

https://docs.google.com/document/d/1e50G6fh5KmbkHcaOi9JP5hFuMaYIrHy5GSPBwx3IlRg/edit

## php -f convert_csv_to_json_xml.php [path/to/csv]

CLI Command to convert CSV file into JSON and XML file

Execute the above command in the root folder of this project

This command will save into backend/storage/data

privileeOffers.json
privileeOffers.xml

### CSV Example

In the root of the project you can find the test.csv file to use for the import of data

### php -S 127.0.0.1:8000 -t backend

Run this command in the root folder to run serve that will respond at localhost:8000

This will serve the localhost:8000 server which expose the get-api/{name}/{discount} REST API to retrieve hotels/offers list

### npm init
### npm start

FrontEnd to display carousel image based on rest api

To run the front end application go inside frontend folder and run the above commands

This will serve the frontend app on localhost:3000.

The FrontEnd app will display all the list of hotels uploaded via csv file with the uploader.
It's possible to filter the image basing of Resort Name (the search is not a string equality, but it's a strpos so even if user search 'five', API will returns 'Five Hotel') and Discount Percentage (the discount percentage is a equality)

### Considerations

The challenge was not so hard but it was hard to stay in the indicated time.
I have to be honest, actual time used was a bit more as i needed to pick up PHP language as it was sometime that i was not use it.
By the way, i did not find too many difficult and the developement was pretty much smooth.


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)