# DisplayCase 
A curated and filterable collection of items akin to a physical library display case. This effort hopes to create a sortable "visual catalog" of curated items for a digital display case. 

Each "item" for display are composed of one or more of the following elements: Image, Title, Description, Link and Keywords. A lot of visual impact is gained when all these elements are used together but the only _required_ element, which must be implemented with any combination of the other elements, is the Keywords. This is the crux of the tool, it facilitates the sorting and filtering action of your DisplayCase. 

The user experience we are creating allows a visitor to come to our page and use our curated list of keywords to filter and sort our content cards to discover some content that interests them, so that they can pursue further understanding by following a link to an explanatory destination.

> For example, for _Black History_ month our librarians have prepared a "black-history" tab with content that is composed of about 25 books held in our collection, along with the images of their bookcovers, and have associated a few keywords with each book as appropriate from a short vocabulary that had been created previously. The visitor would see our DisplayCase at the URL "/displaycase/black-history/" and might click on the "Equity" keyword to view the 11 or so books which are associated with that topic. After reading a brief summary of a particular book, the visitor might click on the content card and be taken to our library catalog where they can go through the process of checking out a copy.

## Technical Requirements

 - <b>Database:</b> Publically-viewable [Google Sheet](https://www.google.com/sheets/about/) for the data backend.
 - <b>Image Storage:</b> If images are desired, a robust, publically-accessible online storage location is needed. (Dropbox, S3 Bucket, CONTENTdm, etc)
 - <b>Apache Web Server:</b> for the PHP script files; this is where web visitors will view the DisplayCase.
 - <b>Cloud Services:</b> A [developer API Key](https://cloud.google.com/docs/authentication/api-keys), from the [Google Cloud Platform](https://cloud.google.com/), for accessing [Google Sheets API](https://developers.google.com/sheets/api/guides/concepts).

## Installation and Configuration Summary

The following is the overview of how this tool stack will be installed and configured. More details will follow that will assist you in accomplishing each of these topics.

- [Create a Google Sheet](#sheet) data backend and configure it for public access. 

    - Using the built-in Google Sharing features, give permissions to any content editors. 
    - Prepare the content of the first tab using the proper format and example data.

- Secure a [Google Developer API Key](#key) for use with this tool stack.

- [Copy these files](#files) to a Web Server. Customize the configurable files for your use.

- [Test the installation](#test).

- [Prepare your image storage](#image) location, either locally on the web server or through an online service.

- [Edit your data backend](#data) with real information. Your done!

### <a href="sheet"></a>Preparing a Google Sheet

- Create a data backend using Google Sheets and insert the necessary template (column and row) content.

### <a href="key"></a>Create a Google API Key

- No instructions yet._

### <a href="files"></a>Copy the Web Files

- Ensure that the Apache server is configured to use .htaccess files.
- Create a directory or sub-directory in the Apache webroot.
- Copy the contents of the "files" folder into this new server directory.
- Update the .htaccess file with the correct "RewriteBase" value (the path from web root). 
- Complete the configuration process by inserting accurate values in the "configuration.php" settings file.
- Activate the "include" files, found in "assets/includes", by removing the "-dist" from the file extension.


### <a href="test"></a>Verify with Testing
- The page should now be accessible by browser, so visit a few testing links.

### <a href="image"></a>Prepare Image Storage

- No instructions yet._

### <a href="data"></a>Enter Real Data

- Return to the Header and Footer files to add valid HTML or PHP for page branding.
- Create new tabs in Google Sheet, using the example data and formatting, to start using the tool.
