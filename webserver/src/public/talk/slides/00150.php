<section class="slide">
    <h2>DISTRIBUTED SERVICES</h2>
    <h3><span style="padding-left:6px;padding-right:6px;background-color: #ffab62"><font color="red">WHY</font></span> / WHEN / HOW</h3>
    <div id="S00150-div" style="display: none; float: right; z-index: 10;">
        <img id="S00150-img" src="images/LAMP-STACK.png" />
    </div>
    <h4>But we do PHP</h4>
		<ul>
		<li class="slide">
		Sometimes the Request/Response cycle doesn't fit your use case
		</li>
		<li class="slide">
		Long running calls can block a PHP thread/process consuming valuable "frontend" client facing resources 
		</li>
		<li class="slide">
		Users get the dreaded "spinny" which is just the modern version of the 1990s loading bar but now it's circular with no end 
		</li>
		<li class="slide">
		Hard Separation of Concern (SoC)
			<ul>
			<li class="slide">A common manifestation of this is a company's "service offering" looks earily similar to it's Earth bound physical geography</li>
			</ul>
		</li>
		</ul>
    <?=LastSlide("#S00150-30");?>
</section>

