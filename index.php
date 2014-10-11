<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/finder.css">       
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div class="main">
            <div id="filter" class="container">
                <form name="filter" id="finderForm">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12"><h1> Werbepylon-Finder</h1></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12"><h3> Form</h3></div>
                    </div>
                    <div class="safari-fix row">
                        <div class="col-lg-4 col-xs-12 col-md-4">
                            <label>
                                <input type="radio" name="form" value="normal" /> 
                                <img class="img-responsive" alt="Normal" src="images/shapes/normal.png" />
                                <p>Normal</p>
                            </label>
                        </div> 
                        <div class="col-lg-4 col-xs-12 col-md-4">
                            <label>
                                <input type="radio" name="form" value="triangular" /> 
                                <img class="img-responsive" alt="Dreieckig" src="images/shapes/triangular.jpg" />
                                <p>Dreieckig</p>
                            </label>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-4">
                            <label>
                                <input type="radio" name="form" value="cubical" /> 
                                <img class="img-responsive" alt="Quaderförmig" src="images/shapes/cubical.jpg" />
                                <p>Quaderförmig</p>
                            </label>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12"><h3> Bauart</h3></div>                   
                    </div>
                    <div class="safari-fix row">
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="radio" name="shape" value="straight" /> 
                                <img class="img-responsive" alt="Gerade" src="images/shapes/straight.jpg" />
                                <p>Gerade</p>
                            </label>
                        </div>   

                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="radio" name="shape" value="concav" /> 
                                <img class="img-responsive" alt="Konkav" src="images/shapes/concav.jpg" />
                                <p>Konkav</p>
                            </label>
                        </div>   
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="radio" name="shape" value="convex" />
                                <img class="img-responsive" alt="Konvex" src="images/shapes/convex.jpg" />
                                <p>Konvex</p>
                            </label>
                        </div>  
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="checkbox" name="socket" value="yes" /> 
                                <img class="img-responsive" alt="Sockel" src="images/shapes/sockel.jpg" />
                                <p>Sockel</p>
                            </label>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12"><h3>Ausstattung</h3></div>                   
                    </div>
                    <div class="safari-fix row">
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="radio" name="equipment" value="lit" /> 
                                <img class="img-responsive" alt="Beleuchtet" src="images/shapes/lit.jpg" />
                                <p>Beleuchtet</p>
                            </label>
                        </div> 
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="radio" name="equipment" value="unlit" /> 
                                <img class="img-responsive" alt="Unbeleuchtet" src="images/shapes/unlit.jpg" />
                                <p>Unbeleuchtet</p>
                            </label>
                        </div>   
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="checkbox" name="lighting" value="yes" /> 
                                <img class="img-responsive" alt="glass" src="images/shapes/contour.jpg" />
                                <p>Kontur-beleuchtung</p>
                            </label>
                        </div> 
                        <div class="col-lg-3 col-xs-12 col-md-3">
                            <label>
                                <input type="checkbox" name="material" value="glass" /> 
                                <img class="img-responsive" alt="glass" src="images/shapes/glass.jpg" />
                                <p>Aus Glas</p>
                            </label>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12"><h3>Höhe</h3></div>                          
                    </div>
                    <div class="safari-fix row">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <input type="text" name="height" /> mm
                        </div>
                    </div>
                    <div class="safari-fix row">
                        <div class="pull-right col-lg-12 col-xs-12 col-md-12">
                            <button type="button" id="clear" class="pull-right btn btn-sucess"><i class="glyphicon glyphicon-share-alt"></i> Zurücksetzen</button>
                            <button type="submit" class="pull-right btn btn-success"><i class="glyphicon glyphicon-filter"></i> Suchen</button>
                        </div>
                    </div>






                </form>
            </div>
            <hr>
            <div id ="results" class="container">

                <?php
                require('finder.class.php');
                $finder = new finder('products.csv');
                $results = $finder->filter();
                if (is_array($results)) {
                    echo '<ul id="resultsList" class="results">';
                    foreach ($results as $result) {
                        ?>
                        <li><a target="_parent" href="<?php echo $result['url']; ?>"><?php echo $result['name']; ?></a></li>

                        <?php
                    }
                    echo '</ul>';
                } else {
                    echo'<p>Keine Ergebnisse gefunden!</p>';
                }
                ?>

            </div>
        </div>
         <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script> 
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/finder.js"></script> 
    </body>
</html>
