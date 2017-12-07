 <ul style="list-style-type:none;">

                   <!--<li class="filter"> 
                    <a href = "{{url('reviews/gt')}}" 
                               <?php /*if(Request::url() == url('reviews/gt'))
                                            echo "class='filter_active w3-padding'";
                                          else echo "class='w3-padding'"*/
                                ?>
                    >
                            <span class="glyphicon glyphicon-chevron-right"></span>
                                Average
                
                        </a>
                    
                    </li>

                    <li class="filter"> 
                        <a href = "{{url('reviews/lt')}}" 
                                    <?php /*if(Request::url() == url('reviews/lt'))
                                            echo "class='filter_active w3-padding'";
                                          else echo "class='w3-padding'"*/
                                    ?>
                        >
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                    Average
                    
                            </a>
                    
                    </li>

                    <li class="filter"> 
                        <a href = "{{url('reviews')}}" 
                                    <?php if(Request::url() == url('reviews'))
                                            echo "class='filter_active w3-padding'";
                                          else echo "class='w3-padding'"
                                    ?>
                        >-->
                                <!--<span class="glyphicon glyphicon-chevron-left"></span>-->
                                    All
                    
                            <!--</a>
                    
                    </li>-->

                   <span class="glyphicon glyphicon-stats">  
                    AverageRating {{number_format($avg,1)}}/5 
                    TotalReviews {{$total}} 
                </span>
                     
</ul>