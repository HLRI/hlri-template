<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
?>
<div class="container-fluid px-lg-5 my-4">
    <div class="row">
        <div class="col-lg-9 px-4">

            <div class="row floorplan-header mb-4">
                <div class="col-lg-8 d-flex align-items-center px-lg-0">
                    <h1 class="font-weight-bold h2"><?php the_title() ?></h1>
                </div>
                <div class="col-lg-4 text-right px-lg-0">
                    <div class="floorplan-price">
                        From <span class="from-price"><?= $floorplans['opt-floorplans-price-from'] ?></span>
                    </div>
                    <div>
                        <?= $floorplans['opt-floorplans-price-per'] ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-lg-0">
                    <div class="image-floorplan">
                        <?php the_post_thumbnail() ?>
                    </div>
                </div>
            </div>

            <div class="row mt-4 p-lg-4 border py-4">
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            SQ.FT.
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-interior-size'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            TYPE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-beds'] ?>, <?= $floorplans['opt-floorplans-baths'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            EXPOSURE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-view'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            FLOOR RANGE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-floor-range'] ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 px-lg-0">
                    <div id="accordion">
                        <div class="">
                            <div class="card-header p-0" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link px-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Price Per Square Foot
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="row mt-4">
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">THIS FLOOR PLAN</div>
                                            <?php $data = explode('/', $floorplans['opt-floorplans-price-per']) ?>
                                            <div class="square-foot-price"><span><?= $data[0] ?></span>/<?= $data[1] ?></div>
                                            <div class="square-foot-title">Suite Details</div>
                                            <div class="square-foot-item">
                                                <span class="name">Suite Name : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-suite-name'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Beds : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-beds'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Baths : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-baths'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">View : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-view'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Interior Size : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-interior-size'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Floor Range : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-floor-range'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">IMPERIA CONDOS BY TRUMAN AVERAGE</div>
                                            <div class="square-foot-price"><span>$868</span>/sq.ft</div>
                                            <div class="square-foot-title">Prices</div>
                                            <div class="square-foot-item">
                                                <span class="name">Price (From) : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-price-from'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Price Per Sq.Ft : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-price-per'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Mt. Fees per Month : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-mt-fees-per-month'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Parking : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-parking'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Locker : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-locker'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">NEIGHBOURHOOD AVERAGE</div>
                                            <div class="square-foot-price"><span>$0</span>/sq.ft</div>
                                            <div class="square-foot-title">Deposit Structure</div>
                                            <?php echo $floorplans['opt-floorplans-deposit-structure']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
			<div class="content">
				<div class="row">
					<div class="col-8">
						<div class="filter-wrapper">
							<input type="checkbox" class="filter-checkbox" value="Software Engineer"/> Software Engineer
							<input type="checkbox" class="filter-checkbox" value="Accountant"/>  Accountant
							<input type="checkbox" class="filter-checkbox" value="Sales Assistant"/>  Sales Assistant
							<input type="checkbox" class="filter-checkbox" value="Developer"/>  Developer
						</div>
					</div>
					<div class="col-4">
						<div class="btn-group submitter-group float-right">
							<div class="input-group-prepend">
								<div class="input-group-text">Status</div>
							</div>
							<select class="form-control status-dropdown">
								<option value="">All</option>
								<option value="DRF">Draft</option>
								<option value="PCH">Pending Review</option>
								<option value="PAU">Pending Authorisation</option>
								<option value="Received">Received</option>
								<option value="Processing">Processing</option>
								<option value="Query">Query</option>
								<option value="Approved">Approved</option>
								<option value="Rejected">Rejected</option>
								<option value="Amended">Amended</option>
								<option value="Cancelled">Cancelled</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<table id="example" class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
						<th>Status</th>
            <th>Hidden</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Garrett Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2011/07/25</td>
						<td>$170,750</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Ashton Cox</td>
						<td>Junior Technical Author</td>
						<td>San Francisco</td>
						<td>66</td>
						<td>2009/01/12</td>
						<td>$86,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Pending Review
							</div>
						</td>
            <td>PCH</td>
					</tr>
					<tr>
						<td>Cedric Kelly</td>
						<td>Senior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2012/03/29</td>
						<td>$433,060</td>
						<td>
							<div class="badge status-badge badge-info">
                Draft
              </div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Airi Satou</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>33</td>
						<td>2008/11/28</td>
						<td>$162,700</td>
						<td>
							<div class="badge status-badge badge-info">
								Pending Review
							</div>
						</td>
            <td>PCH</td>
					</tr>
					<tr>
						<td>Brielle Williamson</td>
						<td>Integration Specialist</td>
						<td>New York</td>
						<td>61</td>
						<td>2012/12/02</td>
						<td>$372,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Herrod Chandler</td>
						<td>Sales Assistant</td>
						<td>San Francisco</td>
						<td>59</td>
						<td>2012/08/06</td>
						<td>$137,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Rhona Davidson</td>
						<td>Integration Specialist</td>
						<td>Tokyo</td>
						<td>55</td>
						<td>2010/10/14</td>
						<td>$327,900</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Colleen Hurst</td>
						<td>Javascript Developer</td>
						<td>San Francisco</td>
						<td>39</td>
						<td>2009/09/15</td>
						<td>$205,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Sonya Frost</td>
						<td>Software Engineer</td>
						<td>Edinburgh</td>
						<td>23</td>
						<td>2008/12/13</td>
						<td>$103,600</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Jena Gaines</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>30</td>
						<td>2008/12/19</td>
						<td>$90,560</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Quinn Flynn</td>
						<td>Support Lead</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2013/03/03</td>
						<td>$342,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Charde Marshall</td>
						<td>Regional Director</td>
						<td>San Francisco</td>
						<td>36</td>
						<td>2008/10/16</td>
						<td>$470,600</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Haley Kennedy</td>
						<td>Senior Marketing Designer</td>
						<td>London</td>
						<td>43</td>
						<td>2012/12/18</td>
						<td>$313,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Tatyana Fitzpatrick</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>19</td>
						<td>2010/03/17</td>
						<td>$385,750</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Michael Silva</td>
						<td>Marketing Designer</td>
						<td>London</td>
						<td>66</td>
						<td>2012/11/27</td>
						<td>$198,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Paul Byrd</td>
						<td>Chief Financial Officer (CFO)</td>
						<td>New York</td>
						<td>64</td>
						<td>2010/06/09</td>
						<td>$725,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Gloria Little</td>
						<td>Systems Administrator</td>
						<td>New York</td>
						<td>59</td>
						<td>2009/04/10</td>
						<td>$237,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Bradley Greer</td>
						<td>Software Engineer</td>
						<td>London</td>
						<td>41</td>
						<td>2012/10/13</td>
						<td>$132,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Dai Rios</td>
						<td>Personnel Lead</td>
						<td>Edinburgh</td>
						<td>35</td>
						<td>2012/09/26</td>
						<td>$217,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Jenette Caldwell</td>
						<td>Development Lead</td>
						<td>New York</td>
						<td>30</td>
						<td>2011/09/03</td>
						<td>$345,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Yuri Berry</td>
						<td>Chief Marketing Officer (CMO)</td>
						<td>New York</td>
						<td>40</td>
						<td>2009/06/25</td>
						<td>$675,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Caesar Vance</td>
						<td>Pre-Sales Support</td>
						<td>New York</td>
						<td>21</td>
						<td>2011/12/12</td>
						<td>$106,450</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Doris Wilder</td>
						<td>Sales Assistant</td>
						<td>Sidney</td>
						<td>23</td>
						<td>2010/09/20</td>
						<td>$85,600</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Angelica Ramos</td>
						<td>Chief Executive Officer (CEO)</td>
						<td>London</td>
						<td>47</td>
						<td>2009/10/09</td>
						<td>$1,200,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Gavin Joyce</td>
						<td>Developer</td>
						<td>Edinburgh</td>
						<td>42</td>
						<td>2010/12/22</td>
						<td>$92,575</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Jennifer Chang</td>
						<td>Regional Director</td>
						<td>Singapore</td>
						<td>28</td>
						<td>2010/11/14</td>
						<td>$357,650</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Brenden Wagner</td>
						<td>Software Engineer</td>
						<td>San Francisco</td>
						<td>28</td>
						<td>2011/06/07</td>
						<td>$206,850</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Fiona Green</td>
						<td>Chief Operating Officer (COO)</td>
						<td>San Francisco</td>
						<td>48</td>
						<td>2010/03/11</td>
						<td>$850,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Shou Itou</td>
						<td>Regional Marketing</td>
						<td>Tokyo</td>
						<td>20</td>
						<td>2011/08/14</td>
						<td>$163,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Michelle House</td>
						<td>Integration Specialist</td>
						<td>Sidney</td>
						<td>37</td>
						<td>2011/06/02</td>
						<td>$95,400</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Suki Burks</td>
						<td>Developer</td>
						<td>London</td>
						<td>53</td>
						<td>2009/10/22</td>
						<td>$114,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Prescott Bartlett</td>
						<td>Technical Author</td>
						<td>London</td>
						<td>27</td>
						<td>2011/05/07</td>
						<td>$145,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Gavin Cortez</td>
						<td>Team Leader</td>
						<td>San Francisco</td>
						<td>22</td>
						<td>2008/10/26</td>
						<td>$235,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Martena Mccray</td>
						<td>Post-Sales support</td>
						<td>Edinburgh</td>
						<td>46</td>
						<td>2011/03/09</td>
						<td>$324,050</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Unity Butler</td>
						<td>Marketing Designer</td>
						<td>San Francisco</td>
						<td>47</td>
						<td>2009/12/09</td>
						<td>$85,675</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Howard Hatfield</td>
						<td>Office Manager</td>
						<td>San Francisco</td>
						<td>51</td>
						<td>2008/12/16</td>
						<td>$164,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Hope Fuentes</td>
						<td>Secretary</td>
						<td>San Francisco</td>
						<td>41</td>
						<td>2010/02/12</td>
						<td>$109,850</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Vivian Harrell</td>
						<td>Financial Controller</td>
						<td>San Francisco</td>
						<td>62</td>
						<td>2009/02/14</td>
						<td>$452,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Timothy Mooney</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>37</td>
						<td>2008/12/11</td>
						<td>$136,200</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Jackson Bradshaw</td>
						<td>Director</td>
						<td>New York</td>
						<td>65</td>
						<td>2008/09/26</td>
						<td>$645,750</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Olivia Liang</td>
						<td>Support Engineer</td>
						<td>Singapore</td>
						<td>64</td>
						<td>2011/02/03</td>
						<td>$234,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Bruno Nash</td>
						<td>Software Engineer</td>
						<td>London</td>
						<td>38</td>
						<td>2011/05/03</td>
						<td>$163,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Sakura Yamamoto</td>
						<td>Support Engineer</td>
						<td>Tokyo</td>
						<td>37</td>
						<td>2009/08/19</td>
						<td>$139,575</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Thor Walton</td>
						<td>Developer</td>
						<td>New York</td>
						<td>61</td>
						<td>2013/08/11</td>
						<td>$98,540</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Finn Camacho</td>
						<td>Support Engineer</td>
						<td>San Francisco</td>
						<td>47</td>
						<td>2009/07/07</td>
						<td>$87,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Serge Baldwin</td>
						<td>Data Coordinator</td>
						<td>Singapore</td>
						<td>64</td>
						<td>2012/04/09</td>
						<td>$138,575</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Zenaida Frank</td>
						<td>Software Engineer</td>
						<td>New York</td>
						<td>63</td>
						<td>2010/01/04</td>
						<td>$125,250</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Zorita Serrano</td>
						<td>Software Engineer</td>
						<td>San Francisco</td>
						<td>56</td>
						<td>2012/06/01</td>
						<td>$115,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Jennifer Acosta</td>
						<td>Junior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>43</td>
						<td>2013/02/01</td>
						<td>$75,650</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Cara Stevens</td>
						<td>Sales Assistant</td>
						<td>New York</td>
						<td>46</td>
						<td>2011/12/06</td>
						<td>$145,600</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Hermione Butler</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>47</td>
						<td>2011/03/21</td>
						<td>$356,250</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Lael Greer</td>
						<td>Systems Administrator</td>
						<td>London</td>
						<td>21</td>
						<td>2009/02/27</td>
						<td>$103,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Jonas Alexander</td>
						<td>Developer</td>
						<td>San Francisco</td>
						<td>30</td>
						<td>2010/07/14</td>
						<td>$86,500</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Shad Decker</td>
						<td>Regional Director</td>
						<td>Edinburgh</td>
						<td>51</td>
						<td>2008/11/13</td>
						<td>$183,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Michael Bruce</td>
						<td>Javascript Developer</td>
						<td>Singapore</td>
						<td>29</td>
						<td>2011/06/27</td>
						<td>$183,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
					<tr>
						<td>Donna Snider</td>
						<td>Customer Support</td>
						<td>New York</td>
						<td>27</td>
						<td>2011/01/25</td>
						<td>$112,000</td>
						<td>
							<div class="badge status-badge badge-info">
								Draft
							</div>
						</td>
            <td>DRF</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>
							<input type="text" id="search_0"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Name"/>
						</th>
						<th>
							<input type="text" id="search_1"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Position"/>
						</th>
						<th>
							<input type="text" id="search_2"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Office"/>
						</th>
						<th>
							<input type="text" id="search_3"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Age"/>
						</th>
						<th>
							<input type="text" id="search_4"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Start date"/>
						</th>
						<th>
							<input type="text" id="search_5"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Salary"/>
						</th>
						<th>
							<!--<input type="text" id="search_6"
								class="form-control input-xs table-filter"
								style="width: 100%;"
								placeholder="Status"/>  -->
              <select class="form-control status-dropdown">
								<option value="">All</option>
								<option value="DRF">Draft</option>
								<option value="PCH">Pending Review</option>
								<option value="PAU">Pending Authorisation</option>
								<option value="Received">Received</option>
								<option value="Processing">Processing</option>
								<option value="Query">Query</option>
								<option value="Approved">Approved</option>
								<option value="Rejected">Rejected</option>
								<option value="Amended">Amended</option>
								<option value="Cancelled">Cancelled</option>
							</select>
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
            
        </div>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 px-4">
            <?php if ($theme_options['opt-properties-status']) : ?>
                <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
                    <div class="properties-shortcode">
                        <div class="titr-list ml-0 mb-2 pb-1 mr-0">
                            <h3 class="font-weight-bold h5 mb-0 text-center">Register Now to get full package , book your unit</h3>
                        </div>
                        <style>
                            <?php echo $theme_options['opt-properties-style'] ?>
                        </style>
                        <div class="card-form">
                            <?= do_shortcode($theme_options['opt-properties-shortcode']) ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>