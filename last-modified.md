# Automation of Last-Modified Date

There is an optional feature which allows you to include a last-modified date for the page (or tab). In summary,
the manual method is to put a text string representing a date or timestamp; and it will then be included at the page 
bottom, in a "p" tag which includes a "Last Modified:" label in front of it. 
**IMPORTANT: This text string is unchecked and not verified as _valid_ so it is up to the Editor to make sure it is correct.**

More importantly, there is a way to _automate_ this date value and keep it updated **whenever a change is made** to
that Google Sheet--and that is the point of this documentation, to inform you how to accomplish this task.

## Summary of the Date Display Feature

1. If there is no value in the **E1** cell, then no last-modified date will be displayed.
2. Any value entered in the **E1** cell will be displayed, so make sure it is a understandable timestamp.
3. If one chooses to automate the inclusion of a last-modified date, it will be populated in in the **E1** cell on **every** tab in the spreadsheet. 

## Preparation of the Google Sheet

This section of the documentation explains what is necessary to display an automated date in the **E1** cell of your spreadsheet.

### Technical Requirements

- You must be using DisplayCase version **3.1.0** and higher.
- You must have the ability to _create_ an **Apps Script** associated with your target Google Sheet.
- You must have a Google-enabled user account, under which this new task will run.

### Instructions to Enable Automatic Date Inclusion

Follow these steps to modify the Google Sheet so that dates will show in the **E1** cell every time a page/tab is modified.

1. In a browser, open the target Google Sheet that is the data backend for your DisplayCase.
2. Click the "Extensions" menu link, in the file menu bar near the top of the page, and select "Apps Script".
3. In the new tab which opens up, click the "Untitled Project" text shown at the top of the page and rename this project in a fashion similar to the Google Sheet. (For example, my Sheet is named "Teacher Resource Center" because it holds all of the digital display cases for that group; and so I would name the project identically, to associate the two together.)
4. Copy and paste the code block found later in this document into the "Code.gs" window, replacing the existing and empty "``function myFunction()``" code block.
5. "Save the Project" by clicking the _floppy disk icon_ located above the code window and to the left of the "Run" command.
6. Hover your mouse over the _alarm clock icon_ found in the left-most column, past the "Services" link, and click the "Triggers" text link that appears.
7. Click the "Add a Trigger" button at the bottom of the resulting page, and choose the "Event Type" option from the menu.
8. Ensure that the changeable values are: "setModifiedDate", "Head", and "From spreadsheet".
9. Change the "Select event type" value to "On change" and click "Save" button. (You can _optionally_ alter the "Failure notification settings" if you desire.)
10. In the resulting _pop-up_ window, select a Google account under which this task will run.
11. When presented with the "Google hasn’t verified this app" message, click the "Advanced" text link followed by a click on the "Go to ... (unsafe)" link.
12. Read the resulting documentation to understand the risks, then click the "Allow" button. (**IMPORTANT:** The only thing being agreed to in this step is the running of the simple code block that you copied into the project code window--nothing else.)
13. Back in the original project trigger window, click the "Save" button once again.
14. Close the _Apps Script_ project window or browser tab and return to the target Google Sheet.
15. In the **D1** cell copy in the following text, formatting it to bold and right-justified:  "Last Modified: " (You might want to copy this text string to every existing tab, in the same cell location.) This D1 text should remind you of the purpose of the E1 cell value.
16. If you hit "return" or "Enter" key and/or make any other change on this page/tab, you can verify that the current date appears in the **E1** cell. 

The instructions are now complete and **every** current and future page/tab will get a date value in the E1 cell after an update occurs. If you want to learn more about customizing Dates and Times used in Google-based scripts, this article talks about [the date object](https://developers.google.com/google-ads/scripts/docs/features/dates).

### Instructions to Remove Automatic Date Inclusion

Use these instructions to remove the automatic date inclusion feature. Using this method, you will remove all actionable code but leave in place the trigger and framework for reinstating the feature later, if desired.

1. In a browser, open the target Google Sheet that is the data backend for your DisplayCase.
2. Click the "Extensions" menu link, in the file menu bar near the top of the page, and select "Apps Script".
3. In the code block, remove or delete all code between the "curly brackets" ("{}") of the "``function setModifiedDate(e)``" statement.
4. "Save the Project" by clicking the _floppy disk icon_ located above the code window and to the left of the "Run" command.

---

## Miscellaneous Information

### Function Code to Copy

This is the "gs" code that you should copy and pasted into the _Apps Script_ project code window-be sure to copy it entirely.

    function setModifiedDate(e) {
        // Prevent errors if no object is passed.
        if (!e) return;
        // Get the active sheet.
        e.source.getActiveSheet()
            // Set the cell you want to update with the date.
            .getRange('E1')
            // Update the date.
            .setValue(new Date());
    }

While retaining the space indentation makes the code more readable by a human, it is not necessary for it to work.

### Change the Format of the Date

If you want more than just the date to show or want to alter the presentation of the date, this is how. You use the built-in spreadsheet features to accomplish this task.

1. In a browser, open the target Google Sheet that is the data backend for your DisplayCase.
2. Click in the **E1** cell with your mouse.
3. In the format section of the toolbar, near the "$  % .0  .00" links, click the "More formats" ("123") link.
4. Select and explore your options from one of the date oriented choices: "Date", "Date time", or "Custom date and time".

Once you have made your format choice, that cell should be displaying the text in the format you chose--this will then be displayed on the DisplayCase page. **NOTE: You will need to perform this customization on every existing tab.**