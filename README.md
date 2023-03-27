# DisplayCase 
A curated and filterable collection of items akin to a physical library display case. This tool aim to create a sortable "visual catalog" of curated content blocks for a digital display case. 

Each "item" for display is composed of one or more of the following elements: Image, Title, Description, Link and Keywords. A lot of visual impact is gained when all these elements are used together but the only _required_ element, which must be implemented with any combination of the other elements, is the Keywords. **Keywords are the crux of the tool, it facilitates the sorting and filtering action of your DisplayCase; without this feature, you just have a web page.**

The user experience we are creating allows a visitor to come to our page and use our curated list of keywords to filter and sort our content cards to discover some content that interests them, so that they can pursue further understanding by following a link to an explanatory destination.

> For example, for _Black History_ month our librarians have prepared a "black-history" tab with content that is composed of about 25 books held in our collection, along with the images of their bookcovers, and have associated a few keywords with each book as appropriate from a short vocabulary that had been created previously. The visitor would see our DisplayCase at the URL "/displaycase/black-history/" and might click on the "Equity" keyword to view the 11 or so books which are associated with that topic. After reading a brief summary of a particular book, the visitor might click on the content card and be taken to our library catalog where they can go through the process of checking out a copy.

Lastly, this online tool is created for the _non-technical_ librarians or users so that they can implement it quickly and without much knowledge of either programming or HTML. This tool does not use modern programming practices but rather is an older functional style that allows a person to copy files directly from this repository and have a functional product with a minimal set-up.

## Technical Requirements

 - <b>Database:</b> Publically-viewable [Google Sheet](https://www.google.com/sheets/about/) for the data backend.
 - <b>Image Storage:</b> If images are desired, a robust publically-accessible online storage location is needed. (Dropbox, S3 Bucket, CONTENTdm, local web server, etc)
 - <b>Apache Web Server:</b> Needed to house the PHP script files; this is where web visitors will view your DisplayCase(s).
 - <b>Cloud Services:</b> A [developer API Key](https://cloud.google.com/docs/authentication/api-keys), from the [Google Cloud Platform](https://cloud.google.com/), for accessing [Google Sheets API](https://developers.google.com/sheets/api/guides/concepts).

## Installation and Configuration Summary

The following is an overview of how this tool stack should be installed and configured. More instructions will follow that can assist you in accomplishing each of these steps.

- [Create a Google Sheet](#preparing-a-google-sheet) to hold your data and configure it for public access. 
- [Secure a Google Developer API Key](#secure-a-google-api-key) for use with this tool stack.
- [Copy these files](#copy-the-web-files) to a Web Server. Customize the configurable files for your use.
- [Test the installation](#verify-with-testing).
- [Prepare your image storage](#prepare-image-storage) location, either locally on the web server or through an online service.
- [Edit your data backend](#enter-real-data) with real information. You're done!

### Preparing a Google Sheet

- [Create a new Google Sheet](https://www.wikihow.com/Use-Google-Spreadsheets) to hold your data.
- Using the built-in Google _Sharing_ feature, give permissions to any content editors. (Also, make sure to select the "anyone with a link can **view**" option.)
- [Rename the first tab](https://edu.gcfglobal.org/en/googlespreadsheets/working-with-multiple-sheets/1/#) to "example" and insert example data by following the [content template](#google-sheet-template).
- You can either copy data from one of our [Github Example pages](#example-displaycases) or you can put the following (without the quotes) in Row 4, starting with **A4**: "My Title", "Some Content", "https://picsum.photos/300/450", "#", "test"

### Secure a Google API Key

If you already have a valid API key, then there is no need to create a different one--just use that; otherwise a
Google Developer account will be required to [set up an API key](https://support.google.com/googleapi/answer/6158862).

### Copy the Web Files

- Ensure that the Apache server is configured to use **.htaccess** files.
- Create a sub-directory in the Apache webroot. (For example, you could name it "displaycase".)
- Copy the contents of this code repository, both files and folders, into this new directory.
- Update the **.htaccess**  file with the correct "RewriteBase" value, which is the path from web root. (If following our suggestions, this value would be "displaycase".) 
- Complete the configuration process by inserting accurate values in the "configuration.php" settings file. (There are hints contained within that file.)
- Activate the "include" files, found in "assets/includes", by removing the "-dist" from the file extension.

### Verify with Testing

The page should now be accessible by browser on your web server, so visit a few testing links. If you had followed our suggestion of naming the directory "displaycase" then here are the links you can test (paste these strings in the browser address bar after having gone to your web server homepage):

- /displaycase/test = This will show whether **.htaccess** rules are working.
- /displaycase/example = This will show the content of your "example" tab.
- /displaycase/bad = This will show a "404 Not Found" error, because no tab of this name exists.

If you are able to get all of these example pages to show up, then there is a high probability that you've configured the tool correctly.

### Prepare Image Storage

Showing images on the page will give greater impact to your content and controlling the image source files allows you to [optimize these images](https://www.wpbeginner.com/beginners-guide/speed-wordpress-save-images-optimized-web/) for the web and/or mobile users. You will need to find an Internet-accessible place to store these image files. There are many online storage services available, but we can both recommend an [AWS' S3 Bucket](https://docs.aws.amazon.com/AmazonS3/latest/userguide/Welcome.html) and also disparage you from using [Google Drive](https://stackoverflow.com/questions/46874536/why-hosting-images-in-google-sites-from-google-drive-has-stopped-working). You can also use the local "assets/images" folder, if your editors know how to use SFTP.

### Enter Real Data

Now that you've tested your installation files and established your image storage solution, you can start using the DisplayCase tool.

- Return to the Header and Footer "include" files to add valid HTML or PHP for page branding.
- Create new tabs in Google Sheet, using the example data and formatting, to start using the tool.
- We suggest that you keep an "example" tab with some data, so that you can quickly use this to troubleshoot in the future.
- Publish or distribute your new URL (tool folder followed by tab) to your community.

## Example DisplayCases

It should be emphasized that not all content block columns are required to be used on a page. (Sometimes leaving out images is better for a specific purpose, for example.) Here are a few pages with different combinations to inspire you as to how else you can use this tool:

 - [Github DisplayCase Example](https://webapps.library.fresnostate.edu/github-example/displaycase/example)
 - [Github DisplayCase - Empty](https://webapps.library.fresnostate.edu/github-example/displaycase/empty)
 - [Github DisplayCase - Titles Only](https://webapps.library.fresnostate.edu/github-example/displaycase/title)
 - [Github DisplayCase - Content Only](https://webapps.library.fresnostate.edu/github-example/displaycase/content)
 - [Github DisplayCase - Images Only](https://webapps.library.fresnostate.edu/github-example/displaycase/image)
s3-bucket

## Miscellaneous Information

This section holds more information on certain topics mentioned previously.

### Google Sheet Template

This section aims to describe the columns and cells required for this tool to function. First, you should know that Google Sheet is a **free**
online [spreadsheet](https://www.computerhope.com/jargon/s/spreadsheet.htm) tool. To understand where data is to be placed, 
you should be comfortable with the idea that in most spreadsheets the columns are named alphabetically and rows are numeric. 
Consequently, the first data cell in any spreadsheet is referred to as **A1** and is located in Column A and Row 1; the next data cell
in that row would be **B1** or Column B and Row 1.

With that spreadsheet knowledge in mind, here is the required mapping of your data so that the tool works:

- **A1** : This is the title displayed on the page. (While this is technically _optional_, every page deserves a title, right?)
- **A2** : This is the descriptive text that is placed below the title. (_Optional_ and can take simple HTML tags.)
- **A3, B3, C3, D3, E3** : This row only holds the column headings for the data included afterward. (_Optional_ but a good reminder for you; otherwise, Row 3 must exist but will NOT be read.)
- **Rows 4 and Higher** : This is where your content block data is held. The script will read until it finds a completely empty row. (_Required_ for the purpose of the tool, but too many rows of data will confuse the visitor and slow the page.)

You can use the [Github DisplayCase - Empty](https://webapps.library.fresnostate.edu/github-example/displaycase/empty) example page to visualize what is described in the list above. 
