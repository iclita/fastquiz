<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Creative One Page Parallax Template">
    <meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
    <meta name="author" content=""> 
    <title>FastQuiz - Test your knowledge speed</title> 

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <link href="/css/app.css" rel="stylesheet">
    
    <!--[if lt IE 9]> <script src="js/html5shiv.js"></script> 
    <script src="js/respond.min.js"></script> <![endif]--> 
    
    <link rel="shortcut icon" href="images/ico/favicon.png"> 
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png"> 
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png"> 
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png"> 
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <div class="preloader">
        <div class="preloder-wrap">
            <div class="preloder-inner"> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div>
            </div>
        </div>
    </div><!--/.preloader-->
    <header id="navigation"> 
        <div class="navbar navbar-inverse navbar-fixed-top" role="banner"> 
            <div class="container"> 
                <div class="navbar-header"> 
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
                    </button> 
                    <a class="navbar-brand" href="/"><h1><img src="images/logo.png" alt="logo"></h1></a> 
                </div> 
                <div class="collapse navbar-collapse"> 
                    <ul class="nav navbar-nav navbar-right"> 
                        <li class="scroll active"><a href="#navigation">Home</a></li> 
                        <li class="scroll"><a href="#services">How it works</a></li> 
                        <li class="scroll"><a href="#blog">Fast Blog</a></li>
                        @if (Auth::check())
                        <li class="scroll">
                            <div class="dropdown profile">
                                <a class="logout" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li class="scroll"><a class="logout" href="{{ route('logout') }}">My Questions</a></li>
                                    <li class="scroll"><a class="logout" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif 
                    </ul> 
                </div> 
            </div> 
        </div><!--/navbar--> 
    </header> <!--/#navigation--> 

    <section id="home">
        <div id="main-carousel" class="carousel slide" data-ride="carousel"> 
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(images/slider/slide3.jpg)"> 
                    <div class="carousel-caption"> 
                        <div> 
                            <h2 class="heading animated bounceInDown">FastQuiz - Test your knowledge speed</h2> 
                            <p class="animated bounceInUp">Are you fast enough?</p> 
                            @if (Auth::guest())
                            <a class="btn btn-social btn-block btn-facebook" href="{{ route('redirect') }}">
                                <span class="fa fa-facebook"></span> Sign in with Facebook
                            </a>
                            @else
                            <a class="btn btn-default slider-btn animated fadeIn" href="{{ route('login') }}">Play Now</a>
                            @endif 
                        </div> 
                    </div> 
                </div>
        </div>
    </div> 

</section>

    <section id="services" class="parallax-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-8 col-sm-offset-2">
                    <h2 class="title-one">How it works</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="our-service">
                        <div class="services row">
                            <div class="col-sm-4">
                                <div class="single-service">
                                    <i class="fa fa-th"></i>
                                    <h2>Modern Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="single-service">
                                    <i class="fa fa-html5"></i>
                                    <h2>Web Development</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy </p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="single-service">
                                    <i class="fa fa-users"></i>
                                    <h2>Online Marketing</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog"> 
        <div class="container">
            <div class="row text-center clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                    <h2 class="title-one">Fast Blog</h2>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="images/blog/1.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-detail">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-detail" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="images/blog/3.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="images/blog/2.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-two">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-two" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="images/blog/2.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="images/blog/3.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-three">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-three" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="images/blog/3.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="images/blog/3.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-four">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-four" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="images/blog/3.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="images/blog/2.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-six">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-six" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="images/blog/2.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="images/blog/1.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-seven">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-seven" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="images/blog/1.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </section>

    <footer id="footer"> 
        <div class="container"> 
            <div class="text-center"> 
                <p>{{ date('Y') }} &copy; FastQuiz.net | All Rights Reserved</p> 
            </div> 
        </div> 
    </footer> <!--/#footer--> 


<!--     <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="loginModalLabel">Log in</h4>
          </div>
          <div class="modal-body">
            <a href="{{ route('redirect') }}?driver=facebook" class="btn btn-block btn-social btn-facebook">
                <span class="fa fa-facebook"></span> Sign in with Facebook
            </a>
            <hr/>
            <a href="{{ route('redirect') }}?driver=google" class="btn btn-block btn-social btn-google">
                <span class="fa fa-google"></span> Sign in with Google
            </a>
          </div>
        </div>
      </div>
    </div> -->

    <script type="text/javascript" src="/js/app.js"></script> 
</body>
</html>