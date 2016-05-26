 <?php 
 $title = "myVids - Add Video";
 include "header.php"?>
 <div id="main">
                 <form action="processaddvid.php" method="post" enctype="multipart/form-data" id="addvid">
                    <div><label for="title">Title:</label><input type="text" name="title" id="title" /></div>
                    <div>
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating">
                            <option value="0">Select One</option>
                            <option value="1">1 star</option>
                            <option value="2">2 star</option>
                            <option value="3">3 star</option>
                            <option value="4">4 star</option>
                            <option value="5">5 star</option>
                         </select>
                    </div>
                    <div>
                        <label for="genre">Genre:</label>
                        <select id="genre" multiple="multiple" name="genres[]" >   
                           
                              <option value="1">Comedy</option>
                              <option value="2">Horror</option>
                              <option value="3">Drama</option>
                          
                         </select>
                    </div>
                     <fieldset>
                          <legend>MPAA Rating</legend>
                              <input type="radio" name="mpaa" id="G" value="G"/><label for="G">G</label>
                              <input type="radio" name="mpaa" id="PG" value="PG"/><label for="PG">PG</label>
                              <input type="radio" name="mpaa" id="PG-13" value="PG-13"/><label for="PG-13">PG-13</label>
                              <input type="radio" name="mpaa" id="R" value="R"/><label for="R">R</label>
                              <input type="radio" name="mpaa" id="NC-17" value="NC-17"/><label for="NC-17">NC-17</label>
                      </fieldset>
                      <div>
                      	<label for="year">Year:</label>
                        <input type="text" name="year" id="year" size="6" maxlength="4" />
                      </div>
                      <div>
                      	<label for="runtime">Run Time:</label>
                        <input type="text" name="runtime" id="runtime" size="6" maxlength="4"  />
                        <span class="note">(mins)</span>
                      </div>
                      <div>
                      	<label for="trelease">Theatre Release:</label>
                        <input type="text" name="trelease" id="trelease" />
                         <span class="note">MM/DD/YYYY</span>
                      </div>
                      <div>
                      	<label for="drelease">DVD Release:</label>
                        <input type="text" name="drelease" id="drelease" />
                        <span class="note">MM/DD/YYYY</span>
                      </div>
                      
                      
                      <div>
                      	<label for="actors">Actors:</label>
                        <input type="text" name="actors" id="actors" />
                      </div>
                      <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                        <label for="cover">Cover:</label>
                        <input type="file" name="cover" id="cover" />
                      </div>
                      <div>
                      	<label for="studio">Studio:</label>
                        <input type="text" name="studio" id="studio" />
                      </div>
                      <div><label for="plot">Plot Summary:</label><textarea rows="5" cols="75" name="plot" id="plot"></textarea></div>
                      <fieldset>
                          <legend>Video Type</legend>
                              <input type="checkbox" name="hasDVD" id="dvd"/><label for="dvd">DVD</label>
                              <input type="checkbox" name="type[]" id="bluray" /><label for="bluray">BluRay</label>
                              <input type="checkbox" name="type[]" id="digitalsd" /><label for="digitalsd">Digital SD</label>
                              <input type="checkbox" name="type[]" id="digitalhd" /><label for="digitalhd">Digital HD</label>
                      </fieldset>
                      
                      <div id="buttons">
                          <input type ="submit" name="submit" value="Add Video" />
                          <input type="reset" name="reset" value ="Reset" />
                      </div>
           
                    </form>
              
                </div> <!--close main-->
<?php include "footer.php"?>
