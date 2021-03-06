<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
 global $base_path;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<?php print $head; ?>
	<title><?php print $head_title; ?></title>
	<?php print $styles; ?>
	
    <!-- Favicon -->
    <link rel="shortcut icon" sizes="32x32 64x64" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/64_favicon.png">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php print $base_path; ?>themes/sisters/resources/images/icons/apple-touch-icon-180x180.png" />

    <meta name="author" content="<?php print $head_title_array['name']; ?>">

    <!-- Facebook: OpenGraph -->
    <meta property="og:title" content="<?php print $head_title_array['title']; ?>" />
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php print $GLOBALS['base_url'] . request_uri(); ?>">
    <meta property="og:site_name" content="<?php print $head_title_array['name']; ?>"/>
    
    
    <script type="text/javascript" src="<?php print $base_path; ?>themes/sisters/resources/js/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="http://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.css" type="text/css" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />    
    
</head>
<body class="<?php print $classes; ?>">
    
    <div id="site-wrapper" class="non-homepage">
    
    	<?php if(!drupal_is_front_page()): ?>
    	
    		<?php
				  $navigation = 'navigation_view';
				  print views_embed_view($navigation);
			?>
    	
		<?php endif ?>
    
    	<?php print $page_top; ?>
		<?php print $page; ?>
		
		<?php include('includes/footer.php'); ?>


        <!-- Modal -->

        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="custom_search_modal" method="get" accept-charset="UTF-8">
                   
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
    
    						<h2>Advanced Search</h2>
                        </div>
                        <div class="modal-body search-modal-body">
                            <div class="search-filter">
                                <p>Keyword Search <a href="javascript: (0);" data-resettype="keywords" class="search-reset">Reset</a></p>
                                <input autocomplete="off" title="Enter the terms you wish to search for." type="text" name="searchterm" id="title-textbox" size="15" maxlength="128" class="form-text form-control" placeholder="Search the collection" />
                            </div>
                            <div class="search-filter">
                                <p>Date(s) <a href="javascript: (0);" data-resettype="dates" class="search-reset">Reset</a></p>

                                <div class="dates-filter">
    								<input autocomplete="off"  class="date-date form-text form-control date-control start-date" type="text" name="start_year" id="start_year" size="60" maxlength="128" placeholder="1800">
                                    <span class="dates-separator">&ndash;</span>
    								<input autocomplete="off"  class="date-date form-text form-control date-control end-date" type="text" name="end_year" id="end_year" size="60" maxlength="128" placeholder="2015">
                                </div>
                            </div>
                            <div class="search-filter">
                                <p>Subjects <a href="javascript: (0);" data-resettype="subjects" class="search-reset">Reset</a></p>
    
                                <div class="subjects-filter">
    								<input type="text" id="subject-textbox" name="subject" size="30" maxlength="128" class="form-text form-control subject-text" placeholder="Student activities, Chemistry">
                                </div>
                            </div>
                            <div class="search-filter">
                                <p>Format <a href="javascript: (0);" data-resettype="itemtype" class="search-reset">Reset</a></p>
    
                                <div class="itemtype-filter">
    								<input type="text" autocomplete="off" id="itemtype-textbox" name="type" size="30" maxlength="128" class="form-text form-control itemtype-text" placeholder="Scrapbook">
                                </div>
                            </div>
                            <div class="search-filter">
                                <p>Institutions <a href="javascript: (0);" data-resettype="institutions" class="search-reset">Reset</a></p>
    
                                <div class="institutions-filter">
    								<input type="hidden" name="institution" id="institution-textbox" value="" >
                                    <ul class="institution">
                                        <?php
                                        $institutions = array(
                                            'Barnard College' => 'Barnard',
                                            'Smith College' => 'Smith',
                                            'Bryn Mawr College' => 'Bryn',
                                            'Vassar College' => 'Vassar',
                                            'Mt. Holyoke College' => 'Holyoke',
                                            'Wellesley College' => 'Wellesley',
                                            'Radcliffe College' => 'Radcliffe'
                                        );
                                        while(list($key, $value) = each($institutions)): ?>
    
                                        <li>
                                        	<label>
                                        		<input type="checkbox" name="institution_name" class="institutions-filter institution_name" value="<?php echo $value; ?>">
                                        			<?php echo $key; ?>
                                        	</label>
                                        </li>
    
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link">Search the collection &rarr;</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        
        
    </div> <!-- /#site-wrapper -->
    
    <?php print $scripts; ?>
	
	<div id="hidden_forms" style="display:none;">
    	<form class="institution">
    		  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Barnard" checked/> Barnard College
			    </label>
			  </div>
			  
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Bryn" checked/> Bryn Mawr College
			    </label>
			  </div>
			  
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Holyoke" checked/> Mt. Holyoke College
			    </label>
			  </div>
			  
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Radcliffe" checked/> Radcliffe College
			    </label>
			  </div>
			  
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Smith" checked/> Smith College
			    </label>
			  </div>
			  
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Vassar" checked/> Vassar College
			    </label>
			  </div>
			  
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="school" class="school-checkbox" value="Wellesley" checked/> Wellesley College
			    </label>
			  </div>
			  
			  <div class="hidden-form-submit">
			  	<button class="btn btn-link pull-right form-institution-btn" type="submit">Search &rarr;</button>
			  </div>
    	</form>
    	
    	<form class="subjects">
    		 <div class="form-group">
			   <input type="text" autocomplete="off" name="subject" class="form-control input-subject-textbox" placeholder="Subjects" />
			 </div>
			  
			 <div class="hidden-form-submit">
			   <button class="btn btn-link pull-right form-subject-btn" type="submit">Search &rarr;</button>
			 </div>
    	</form>
    	
    	<form class="searchterm">
    		 <div class="form-group">
			   <input type="text" autocomplete="off" name="searchterm" class="form-control input-searchterm-textbox" placeholder="Search Collection" />
			 </div>
			  
			 <div class="hidden-form-submit">
			   <button class="btn btn-link pull-right form-subject-btn" type="submit">Search &rarr;</button>
			 </div>
    	</form>

    </div>
    
    <script type="text/javascript" src="http://cdn.jsdelivr.net/qtip2/2.2.1/basic/jquery.qtip.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        
         	$("form#custom_search_modal").submit(function (e) {
         		 e.preventDefault(); 
         		var path = '<?php echo $base_path ?>';
         		
         		path += 'browse?searchterm='+ getTerm() +'&start_year='+ getStartDate() +'&end_year='+ getEndDate() +'&subject='+ getSubject() +'&type='+ getType() +'&institution=' + getSchools()
         		
         		var theme_id = getParameterByName('theme_id');
         		
         		if(theme_id) {
	         		path += '&theme_id=' + theme_id;
         		}
         		window.location = path;
         	});
            
            $('input[type="text||password"]').addClass('form-control');
            $('input[type="submit"]').addClass('btn btn-block');

            var headlineArray = $('.node-type-basic-page .content-area h3');
        
        	$('#custom_search_modal').submit(function(e){
				var institution = '';
				$('input[type=checkbox].institution_name').each(function() {
					if(this.checked) {
						institution += this.value + ' ';
					}
				});
				$('#institution-textbox').val(institution);
				return true;
			});

            $('.advance-search-link').click(function(){
                $('#search-modal').modal()  
            });

            $('a.search-reset').click(function(){
                var resetType = $(this).data('resettype');

                if (resetType == "subjects") {
                    $('.subjects-filter').find('input').val("");
                }
                
                if (resetType == "itemtype") {
                    $('.itemtype-filter').find('input').val("");
                }

                if (resetType == "keywords") {
                    $('#title-textbox').val("");
                }

                if (resetType == "institutions") {
                    $('.institutions-filter').find('input[type=checkbox]:checked').removeAttr('checked');
                }

                if (resetType == "dates") {
                    $('.dates-filter input').val("");
                }

            });

            $('.flexslider').flexslider({
                animation: "slide"
            });
    	});
    	
    	function getParameterByName(name) {
		    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		        results = regex.exec(location.search);
		    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}
			
    	function performSearch(e) {
	    	 if (e.keyCode == 13){
	    	 	PerformBrowseSearch();
	    	 }
    	}
    	
    	function getSchools() {
	    	var institutions = '';
		    $('form#custom_search_modal input[type=checkbox]').each(function() {
		    	if($(this).is(':checked')) {
		        	institutions += ' ' + this.value;
		        }
		    });
		    
		    return institutions;
    	}
    	
    	function getTerm() {
    		var term = $('#title-textbox').val();
	    	return term;
    	}
    	
    	function getStartDate() {
	    	return 	$('input#start_year').val();	
    	}
    	
    	function getEndDate() {
	    	return 	$('input#end_year').val();
    	}
    	
    	function getSubject() {
	    	return $('input#subject-textbox').val();
    	}
    	
    	function getType() {
	    	return $('input#itemtype-textbox').val();
    	}
    	
    	function PerformBrowseSearch() {
	    	var institutions = '';
		    $('.qtip-form input[type=checkbox]').each(function() {
		    	if($(this).is(':checked')) {
		        	institutions += ' ' + this.value;
		        }
		    });
		      
		    $('input#edit-institution').val(institutions);
		    $('input#edit-subject').val($('.qtip-content .input-subject-textbox').val());
		    
		    $('input#edit-searchterm').val($('.qtip-content .input-searchterm-textbox').val());
		    $('#edit-submit-browse').click();
    	}
    </script>
    
    <script type="text/javascript" src="<?php print $base_path; ?>themes/sisters/resources/jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php print $base_path; ?>themes/sisters/resources/js/autocomplete.js"></script>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-62436914-1', 'auto');
      ga('send', 'pageview');
    </script>
    
</body>
</html>