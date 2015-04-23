<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
 
$related_nodes = array();

$tag_arr = array();
$ts = $node->field_themes['und'];
  
  foreach($ts as $t) {
  	if($t) {
  		array_push($tag_arr, $t['taxonomy_term']->tid);  
  	}
  }
  $related_nodes = array();
if(count($tag_arr) > 0) {
	$query = new EntityFieldQuery();
	$query->entityCondition('entity_type', 'node')
	  ->entityCondition('bundle', 'browse_item')
	  ->propertyCondition('status', 1)
	  ->fieldCondition('field_institution', 'value', $node->field_institution['und'][0]['value'], '!=');
	$query->fieldCondition('field_themes', 'tid', $tag_arr)->range(0, 25);
	  
	
	
	$result = $query->execute();
	$related_keys = array_keys($result['node']);
	shuffle($related_keys);
	$related_nodes = array_slice(entity_load('node', $related_keys), 0, 6, TRUE);
} else {

}
global $base_url;

?>

<article class="node-<?php print $node->nid; ?>"<?php print $attributes; ?>>
  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    //print render($content);
  ?>
  
  <div class="browse-item-page">
        
        
            <div class="container">
           
                <div class="browse-content">

                    <div class="row">

                        <div class="col-md-5">

                            <div class="browse-photo">
                            	<?php if($node->field_browse_image['und'][0]['value']): ?>
                               		<img 
                               			src="<?php print $node->field_browse_image['und'][0]['value']; ?>" 
                               			alt="<?php print $node->title;?>" 
                               			class="img-responsive" 
                               		/>
                               	<?php endif; ?>
                            </div>
                            
                            <?php if($node->field_pdf_file['und'][0]['uri']): ?>
	                            <div class="text-center hidden-sm">
	                            <br />
	                            	<a class="blue-link pdf-link" data-toggle="modal" href="javascript: void(0);">View PDF</a>
	                            </div>
	                             <div class="modal fade" id="pdf-modal" tabindex="-1" role="dialog" aria-labelledby="pdf-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    	<h4 style="margin:0px;">Viewing PDF</h4>
                    </div>
                    <div class="modal-body search-modal-body">
                    	    <iframe width="100%" height="500px;" src="http://staging.interactivemechanics.com/7sisters/themes/sisters/resources/pdfjs/web/viewer.html?file=<?php echo file_create_url($node->field_pdf_file['und'][0]['uri']) ?>"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-dismiss="modal" class="btn btn-link">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <script>
        	$(document).ready(function() {
	        	$('.pdf-link').click(function(){
                	$('#pdf-modal').modal()  
				});
        	});
        </script>
                            <?php endif; ?>
                            
                            <div class="share-item">
                            	<p>Share this item</p>
                            	<ul class="list-inline">
                                	<li><a 
                                        href="mailto:?subject=<?php print $node->title; ?> on <?php print variable_get('site_name'); ?>&body=Check out <?php print $node->title; ?> on <?php print variable_get('site_name'); ?>.%0D%0A%0D%0A<?php print $GLOBALS['base_url'] . '/node/' . $node->nid; ?>"
                                        target="_blank"
                                        class="social-icon mail">Email</a></li>
                                    <li><a 
                                        href="http://www.facebook.com/sharer/sharer.php?u=<?php print $GLOBALS['base_url'] . '/node/' . $node->nid; ?>"
                                        onclick="return !window.open(this.href, 'Facebook', 'width=500,height=500')"
                                        class="social-icon facebook">Facebook</a></li>
                                    <li><a 
                                        href="https://twitter.com/intent/tweet?text=<?php print $node->title; ?> on <?php print variable_get('site_name'); ?>, <?php print $GLOBALS['base_url'] . '/node/' . $node->nid; ?>"
                                        onclick="return !window.open(this.href, 'Twitter', 'width=500,height=500')"
                                        class="social-icon twitter">Twitter</a></li>
								</ul>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="content-information">

                                <ul class="list-unstyled">
                                    <li>
                                        <div class="content-detail">
                                            <span class="heading">Title</span>
                                            <p><?php print $node->title;?></p>
                                        </div>
                                    </li>

                                    <li>
                                    	<?php if($node->field_institution['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Institution</span>
												<p><?php print $node->field_institution['und'][0]['value'];?></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                    	<?php if($node->field_description['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Description</span>
												<p><?php print $node->field_description['und'][0]['value'];?></p>
											</div>
										<?php endif ?>     
									</li>

                                    <li>
                                    	<?php if($node->field_subject['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Subject</span>
                        	
                    	<?php
                    		$subjects = $node->field_subject['und'];
                    		$subjects_str = "";
							foreach($subjects as $item) {
	                                    			if($item) {
														$subjects_str .= '<p><a href="http://staging.interactivemechanics.com/7sisters/browse?subject=' . trim($item['value']) . '">'. $item['value'] .'</a></p>';
													}
                                    			}
                    	?>
												<p><a href="#"><?php print $subjects_str;?></a></p>
											</div>
										<?php endif ?>
                                    </li>
                                    
                                    <li>
                                    	<?php if($node->field_themes['und']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Themes</span>
                        	
							                    	<?php
							                    		$tags = $node->field_themes["und"];
							                    		$tagstr = "";
														foreach($tags as $item) {
							
								                                    			if($item) {
																					$tagstr .= '<p>'. $item['taxonomy_term']->name .'</p>';
																				}
							                                    			}
							                    	?>
												<p><?php print $tagstr;?></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                    	<?php if($node->field_creator['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Creator</span>
												<p><?php print $node->field_creator['und'][0]['value'];?></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                    	<?php if($node->field_contributor['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Contributor</span>
												<p><a href="#"><?php print $node->field_contributor['und'][0]['value'];?></a></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                        <?php if($node->field_date['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Date</span>
												<p><a href="http://staging.interactivemechanics.com/7sisters/browse?start_year=<?php print $node->field_article_year['und'][0]['value'];?>&end_year=<?php print $node->field_article_end_year['und'][0]['value'];?>"><?php print $node->field_date['und'][0]['value'];?></a></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                        <?php if($node->field_location['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Location</span>
												<p><?php print $node->field_location['und'][0]['value'];?></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li class="detail-divider"></li>

                                    <li>
                                        <?php if($node->field_format['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Format</span>
												<p><?php print $node->field_format['und'][0]['value'];?></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                       <?php if($node->field_physicaldescription['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Physical Description</span>
												<p><?php print $node->field_physicaldescription['und'][0]['value'];?></p>
											</div>
										<?php endif ?>
                                    </li>
                                    
                                    <li>
                                    	<?php if($node->field_transcript['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Transcript</span>
												<p><?php print $node->field_transcript['und'][0]['value'];?></p>
											</div>
										<?php endif ?>     
									</li>

                                    <li class="detail-divider"></li>

                                    <li>
                                        <?php if($node->field_copyright['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Copyright and Use</span>
												<p><?php print $node->field_copyright['und'][0]['value'];?></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                    	<?php if($node->field_url['und'][0]['value']): ?>
                                        	<div class="content-detail">
                                            	<span class="heading">Original Url</span>
												<p><a href="<?php print $node->field_url['und'][0]['value'];?>" target="_blank">View Original</a></p>
											</div>
										<?php endif ?>
                                    </li>

                                    <li>
                                        <div class="content-detail cite-detail">
                                            <span class="heading">Cite this Item</span>
                                            <p><?php 
                                                    if($node->field_creator['und'][0]['value']){
                                                        print $node->field_creator['und'][0]['value'] . '. ';
                                                    }
                                                    print '"' . $node->title . '". ';
                                                    if($node->field_date['und'][0]['value']){
                                                        print $node->field_date['und'][0]['value'] . ' ';
                                                    }
                                                    if($node->field_institution['und'][0]['value']){
                                                        print $node->field_institution['und'][0]['value'];
                                                    }
                                                    if($node->field_location['und'][0]['value'] && $node->field_institution['und'][0]['value']){
                                                        print  ', ';
                                                    }
                                                    if($node->field_location['und'][0]['value']){
                                                        print $node->field_location['und'][0]['value'] . '. ';
                                                    }
                                                    if($node->field_url['und'][0]['value']){
                                                        print $node->field_url['und'][0]['value'] . '.';
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </li>

                                    <li>
                                        <div>
                                            <p>
                                                <?php 
                                                    $institution = $node->field_institution['und'][0]['value'];
                                                    if($institution === 'Bryn Mawr College'){
                                                        $contact_url = 'rappel@brynmawr.edu,emcgonagil@brynmawr.edu';
                                                    } elseif ($institution === 'College Archives, Smith College (Northampton, Massachusetts)'){
                                                        $contact_url = 'elanzi@smith.edu,nyoung@smith.edu';
                                                    } elseif ($institution === 'Wellesley College'){
                                                        $contact_url = 'jane.callahan@wellesley.edu,agraham@wellesley.edu,kstrosch@wellesley.edu';
                                                    } elseif ($institution === 'Mount Holyoke College'){
                                                        $contact_url = 'lfields@mtholyoke.edu,sgoldste@mtholyoke.edu,strujill@mtholyoke.edu';
                                                    } elseif ($institution === 'Vassar College'){
                                                        $contact_url = 'jdipasquale@vassar.edu,lastreett@vassar.edu';
                                                    } elseif ($institution === 'Barnard College'){
                                                        $contact_url = 'mtenney@barnard.edu,soneill@barnard.edu,dsavage@barnard.edu';
                                                    } elseif ($institution === 'Radcliffe College Archives'){
                                                        $contact_url = 'pkaczor@radcliffe.harvard.edu,jennifer_weintraub@radcliffe.harvard.edu,amy_benson@radcliffe.harvard.edu';
                                                    }
                                                ?>
                                                <?php if($contact_url): ?><a style="text-decoration:none; color:#00aeef;" href="mailto:<?php print $contact_url; ?>">
                                                    Contact <?php print $node->field_institution['und'][0]['value'];?> &rarr;</a>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </li>
                                    
                                </ul>

                            </div>
                        </div>
                    </div>



                </div>

            </div>
            
<?php if (!empty($related_nodes)): ?>  
            <div class="gray-area">
            	<div class="container">

            		<div class="similar-items-detail">
            			
            			<div class="row">
            				<div class="col-md-12">

            					<div class="heading-line">
          							<span class="heading-text">
            							SIMILAR ITEMS
          							</span>
        						</div>
            					
            				</div>
            			</div>

            			<div class="similar-items">
            				<div class="row">
            					<div class="col-md-12">

            						<ul class="list-inline text-center">
						<?php 
							foreach($related_nodes as $n):
						?>
						
						<?php if($node->nid != $n->nid): ?>
							<li>
								<a href="<?php print url(drupal_get_path_alias('node/'.$n->nid, array('options' => array('absolute' => TRUE)) )); ?>">
									<img src="<?php print $n->field_browse_thumbnail['und'][0]['value']; ?>" alt="<?php print $n->title;?>" class="img-responsive" />
								</a>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
					</ul>
            					</div>
            				</div>
            			</div>

            		</div> <!-- .similar-items-detail -->

            	</div>
            </div>

        </div>
<?php endif; ?>
            
  
  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article>
