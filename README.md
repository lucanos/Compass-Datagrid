# jQuery Compass-DatagridCompass DataGrid is an ajax-driven data grid that relies on server-side code for its data. Rather than manipulating an existing table or breaking it down into multiple pages, Compass DataGrid takes an empty table and populates it by connecting to a server-side url via ajax. As users interact with the grid, the grid talks with the server-side script letting it know what the user is requesting. The server-side script then provides JSON encoded data for the plugin to update the table.Compass Datagrid will work with any server-side programming language. However, the example in the download is in PHP.## Usage### HTML    <table class="browseTable"><tbody><tr><td></td></tr></tbody></table>    <!-- If you are using the Resizer -->    <div id="ctResizer"></div>    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>    <script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>    <script type="text/javascript" src="js/jquery.compassdatagrid.min.js"></script>    <script type="text/javascript">       $(document).ready(function(){        $(".browseTable").compassDatagrid({          images: 'images/',          url: 'pageData.php'        });      });    </script>### Server-side (PHP)The server-side script must return a JSON string, in the following format:    array(      'pager' => array(array(        // The Page Number being returned        'page' => (int) 1 ,        // The Maximum Page Number ( ceil( $totalRows / $perPage ) )        'pages' => (int) 10 ,        // The Number of Matching Rows        'found' => (int) 95 ,        // The Index of the First Row        'displayingStart' => (int) 1 ,        // The Index of the Last Row        'displayingEnd' => (int) 10      )) ,      'headings' => array(        array(          // The ID for the first column          'id' => (string) 'row' ,          // The Title for the first column          'display' => (string) 'Row #' ,          // (Optional) The CSS Width for the column          'width' => (string) '25%' ,          // (Optional) If Sorted by this column, 'sort-[direction]'          'sort' => (string) 'sort-asc'        ) ,        ...      ) ,      'rows' => array(        array(          // The ID-indexed array of values for the row          '[id]' => (mixed) '[value]' ,          ...        ) ,        ...      )    );## Options### Javascript<table border="1" cellpadding="2" cellspacing="0">  <thead>    <tr>      <th>Option</th>      <th>Type</th>      <th>Values</th>      <th>Purpose</th>    </tr>  </thead>  <tbody>    <tr>      <th>url<br/>(required)</th>      <td>string</td>      <td>Any (Default:empty)</td>      <td>The URL to your server-side script that will handle the logic.</td>    </tr>    <tr>      <th>images<br/>(required)</th>      <td>string</td>      <td>Any (Default:"images")</td>      <td>The relative path to the Compass Grid images folder.</td>    </tr>    <tr>      <th>hover</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>When set to true, hovering over table cells will activate the .hover css class for css styling. The CSS classname for hover can be changed by changing the hoverClass option.</td>    </tr>    <tr>      <th>hoverClass</th>      <td>string</td>      <td>Any (Default:"hover")</td>      <td>The class to apply to table cells when hovered over.</td>    </tr>    <tr>      <th>selectable</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>When set to true, clicking on a cell "selects" it. We combine this in Compass with a checkbox for each row. The CSS classname for this can be changed by changing the selectableClass option.</td>    </tr>    <tr>      <th>selectableClass</th>      <td>string</td>      <td>Any (Default:"selected")</td>      <td>The class to be applied to a cell when clicked.</td>    </tr>    <tr>      <th>sort</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Allows users to sort columns (although logic for this must be incorporated into server-side script).</td>    </tr>    <tr>      <th>ajax</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Use AJAX to collect the data to fill the table.</td>    </tr>    <tr>      <th>striping</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Striping will alternate classes for table rows (default classes .odd and .even). CSS classes can be changed by altering oddClass and evenClass options.</td>    </tr>    <tr>      <th>oddClass</th>      <td>string</td>      <td>Any (Default:"odd")</td>      <td>The CSS class to apply to odd-numbered rows.</td>    </tr>    <tr>      <th>evenClass</th>      <td>string</td>      <td>Any (Default:"even")</td>      <td>The CSS class to apply to even-numbered rows.</td>    </tr>    <tr>      <th>resizable</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Setting to true allows users to resize columns. This is currently a little buggy, so use at your own risk. Request jQuery UI / Resizable to work.</td>    </tr>    <tr>      <th>resizeOpacity</th>      <td>double</td>      <td>0-1 (Default:0.65)</td>      <td>The opacity of the element when resizing.</td>    </tr>    <tr>      <th>resizer</th>      <td>string</td>      <td>Any (Default:"ctResizer")</td>      <td>The element to use when resizing.</td>    </tr>    <tr>      <th>toggle</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Setting to true allows users to toggle columns on or off. A "Show/Hide Columns" box is added automatically.</td>    </tr>    <tr>      <th>toggleHolder</th>      <td>string</td>      <td>Any (Default:"toggleHolder")</td>      <td>TBA.</td>    </tr>    <tr>      <th>pager</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Whether you're using pagination or not.</td>    </tr>    <tr>      <th>pagerBefore</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Set to true to show the "pager bar" above (before) the table.</td>    </tr>    <tr>      <th>pagerAfter</th>      <td>boolean</td>      <td>true/false (Default:true)</td>      <td>Set to true to show the "pager bar" after the table.</td>    </tr>    <tr>      <th>paramsStart</th>      <td>string</td>      <td>Any (Default:"?")</td>      <td>A starting character for passing your server-side script information. Compass Grid defaults to ?foo=bar&this=that</td>    </tr>    <tr>      <th>paramsSeparator</th>      <td>string</td>      <td>Any (Default:"&")</td>      <td>A character for separating your server-side key/value pairs. Compass Grid defaults to ?foo=bar&this=that</td>    </tr>    <tr>      <th>paramsJoin</th>      <td>string</td>      <td>Any (Default:"=")</td>      <td>A character placed between a key and a value in the url. Compass Grid defaults to ?foo=bar&this=that</td>    </tr>    <tr>      <th>perPage</th>      <td>integer</td>      <td>0+ (Default:15)</td>      <td>The number of rows to show per page.</td>    </tr>    <tr>      <th>perPageOptions</th>      <td>array (of integers)</td>      <td>[0+,0+,...] (Default:[10,15,20,25,30,40,50,100])</td>      <td>Options for the number of rows to show per page.</td>    </tr>  </tbody></table>### Server-side Options<table border="1" cellpadding="2" cellspacing="0">  <thead>    <tr>      <th>Option</th>      <th>Type</th>      <th>Values</th>      <th>Purpose</th>    </tr>  </thead>  <tbody>    <tr>      <th>page</th>      <td>integer</td>      <td>1+</td>      <td>The page to be returned.</td>    </tr>    <tr>      <th>sortField</th>      <td>string</td>      <td>Any</td>      <td>The table column that the user is sorting by. The value here will be the id for the column that you specified in your server-side code.</td>    </tr>    <tr>      <th>sortOrder</th>      <td>string</td>      <td>"asc"/"desc"</td>      <td>The order the user wants to sort.</td>    </tr>    <tr>      <th>show</th>      <td>integer</td>      <td>1+</td>      <td>The number of rows to return.</td>    </tr>  </tbody></table>## Dependencies- jQuery v1.3.2+- [jQuery Live Query]## Licencing- Initial code [Copyright 2009 Cristian Graziano]- Dual licenced under [MIT Licence] and [GPL Licence][jQuery Live Query]: https://github.com/brandonaaron/livequery [Copyright 2009 Cristian Graziano]: http://www.compasswebpublisher.com/jquery/compass-datagrid [MIT Licence]: http://www.opensource.org/licenses/mit-license.php [GPL Licence]: http://www.gnu.org/licenses/gpl.html 