<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta charset="UTF-8">
	<title>{if $logged && ($user.newMsg + $user.friend_requests + $user.rewardsToReceive)}({$user.newMsg + $user.friend_requests + $user.rewardsToReceive}) {/if}{if $page_title}{$page_title} {/if}{if !$logged || !$page_title}{if $page_title} - {/if}Secret Republic - Hacking Simulation Browser Based Game - Hacking MORPG{/if}</title>
	{if !$logged}
	<link rel="shortcut icon" href="{$config.url}layout/img/favicon.ico" type="image/x-icon">
	<meta name="description" content="An online hacking simulation Massive Multiplayer Online Role Playing Game based on your browser. We aim to provide something new, a fresh browser gameplay experience. The hacker game for you."/>
	<meta name="revisit" content="After 3 days"/>
	<meta name="Expires" content="never"/>
	<meta name="robots" content="INDEX,FOLLOW"/>
	<meta name="language" content="en"/>
	<meta name="page-type" content="browser game, browsergame"/>
	<meta name="author" content="Secret Republic"/>
	<meta name="publisher" content="Secret Republic"/>
	<meta name="copyright" content="Secret Republic"/>
	<meta name="page-topic" content="free online hacking economical social and simulation browser based game"/>
	<meta name="audience" content="all"/>

{/if} <!--<meta name="viewport" content="width=device-width, initial-scale=0.7">-->
<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=0.8, minimum-scale=0.9, user-scalable=no" />

	<meta property="og:image" content='{$config.url}layout/img/share_logo.png'/>


	<link rel="stylesheet" href="{$config.url}layout/css/reset.css?c=2" type="text/css"/>

    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css">

	<link rel="stylesheet" href="{$config.url}layout/css/custom.css?t=fffff" type="text/css"/>
   <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css?c=2" rel="stylesheet">


	{if $detectDevice.mobile or $detectDevice.tablet}
		<link rel="stylesheet" href="{$config.url}layout/css/mobile.css?t=1" type="text/css"/>
  {else}


	{/if}

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script type="text/javascript">
		url="{$url}";
		main_url="{$config.url}";
		mobile={if $detectDevice.mobile}true{else}false{/if};
		tablet={if $detectDevice.table}true{else}false{/if};


	</script>

</head>
<body id="body">

<div style="position:fixed;top:4px;right:8px;z-index:10000;display:flex;align-items:center;gap:12px;font-size:11px;">
<span style="opacity:0.85;">
<a href="?lang=de" style="color:{if $current_lang eq 'de'}#53c3ec{else}#888{/if};text-decoration:none;">DE</a>
<span style="color:#555;">|</span>
<a href="?lang=en" style="color:{if $current_lang eq 'en'}#53c3ec{else}#888{/if};text-decoration:none;">EN</a>
</span>
</div>

{include file="admin/adminNavigation.tpl"}

{if $smarty.session.detectDevice.mobile}
<div class=" hidden-lg hidden-md">
  <div class="mobileIcon">
		<div class="mobile-menu" >
			<div></div>
			<div></div>
			<div></div>
		</div>

  </div>

  <ul class="sidebar-nav " id="mobileNavigation">
    {if $logged}
      <li><a href="{$config.url}">{$L.NAV_DASHBOARD} ({$user.attacksInProgress})</a></li>
      <li><a href="{$config.url}quests" title="{$L.NAV_MISSIONS}">
        {if $user.in_party}<strong>{$L.NAV_PARTY}</strong>{elseif $user.partyInvites}<strong style='color:white'>{$L.NAV_PARTY} [{$user.partyInvites}]</strong>{else}{$L.NAV_MISSIONS}{/if}</a>
      </li>
      <li><a href="{$config.url}servers">{$L.NAV_SERVERS}</a></li>

      <li><a href="{$config.url}organization">
              {if $user.org_wars}{if $user.org_wars_now}<strong>{$L.NAV_ORG_WAR_NOW}</strong>{else}<strong>{$L.NAV_ORG_WAR}</strong>{/if}{else}{$L.NAV_ORGANIZATIONS}{/if}
            </a></li>

      <li><a href="{$config.url}skills">{$L.NAV_SKILLS}</a></li>
      <li><a href="{$config.url}job">{$L.NAV_JOB_TRAIN}</a></li>
      <li><a href="{$config.url}profile">{$L.NAV_HEADQUARTERS}{if $user.friend_requests} ({$user.friend_requests|floatval|number_format}){/if}</a></li>

      <li><a href="{$config.url}grid">{$L.NAV_GRID}</a></a></li>
	  <li><a href="{$config.url}zones">{$L.NAV_ZONES}</a></li>
      <li><a href="{$config.url}rankings/page/{($user.rank/20)|ceil}#place_{$user.rank}">
        {$L.NAV_RANKINGS}{if $user.rank > 0} ({$user.rank|floatval|number_format}){/if}
      </a></a></li>
      <li><a href="{$config.url}conversations">{if $user.newMsg}<strong>{$user.newMsg|floatval|number_format} {$L.UI_NEW} </strong> {/if} {$L.NAV_MESSAGES}</a></li>
      <li><a href="{$config.url}forum">{$L.NAV_FORUMS}</a></li>
      <li class="logout"><a href="{$config.url}logout" ><span class="glyphicon glyphicon-off"></span></a></li>
    {else}
      <li><a href="{$config.url}">{$L.NAV_HOME_LOGIN}</a></li>
      <li><a href="{$config.url}register">{$L.NAV_NEW_ACCOUNT}</a></li>
      <li><a href="{$config.url}forum"><span class="glyphicon glyphicon-comment"></span></a></li>
      <li><a href="{$config.url}rankings/type/blogs">{$L.NAV_BLOGS}</a></li>
      <li><a href="{$config.url}rankings"><span class="glyphicon glyphicon-list"></span></a></li>
    {/if}
  </ul>
</div>
{/if}

{if $voice}
<audio  class="nodisplay" autoplay = "autoplay">
  <source src="{$config.url}mp3/eve/ogg/{$voice}.ogg" type="audio/ogg">
  <source src="{$config.url}mp3/eve/{$voice}.mp3" type="audio/mpeg">
</audio>
{/if}

<div class="container" {if $smarty.session.detectDevice.mobile}style="width:100%"{/if}>

{if !$no_menu}

	 {if $logged }
   {if $smarty.session.detectDevice.mobile}

	 <div class="text-center hidden-md hidden-lg" >
      <div class="resources-bar top">
          <small>
            <div>
          <span class="glyphicon glyphicon-flash"></span> {$user.energy|floatval|number_format}/{$user.maxEnergy|floatval|number_format}

           </div>

            <div>
         <a href="{$config.url}grid" >
        [{$user.main_node}]
        </a></div>
            <div>
          {$user.money|floatval|number_format}$ &nbsp;&nbsp;<a href="{$config.url}bank"><span class="glyphicon glyphicon-piggy-bank"></span></a>
           </div>
           <div>
           <a href="{$config.url}data-points" >
      {$user.dataPoints|floatval|number_format:2} DP's

        </a>
         </div>
         <div>
         <a href="{$config.url}alpha_coins" >
        {$user.alphaCoins|floatval|number_format} a-c
        </a></div>
        <div>

        <a href="{$config.url}notes" title="{$L.NOTES_TITLE}">
        <span class="glyphicon glyphicon-folder-open"></span>
        </a>
      </div>

      </small>
      </div>
    </div>
    {else}
      <div class="resources-bar text-center bottom hidden-xs hidden-sm">
         <div>
          <small><span class="glyphicon glyphicon-flash"></span></small> {$user.energy|floatval|number_format}/{$user.maxEnergy|floatval|number_format}

           </div>

            <div>
         <a href="{$config.url}grid" >
        [{$user.main_node}]
        </a></div>
            <div>
          {$user.money|floatval|number_format}$ &nbsp;&nbsp;<small><a href="{$config.url}bank"><span class="glyphicon glyphicon-piggy-bank"></span></a></small>
           </div>
           <div>
           <a href="{$config.url}data-points" >
      {$user.dataPoints|floatval|number_format:2} DP's

        </a>
         </div>
         <div>
         <a href="{$config.url}alpha_coins" >
        {$user.alphaCoins|floatval|number_format} a-c
        </a></div>
        <div>

        <a href="{$config.url}notes" title="{$L.NOTES_TITLE}">
        <span class="glyphicon glyphicon-folder-open"></span>
        </a>
      </div>

      </div>

      {/if}
	  {/if}
	  <div class="visible-xs visible-sm">
		<div style="padding:30px">
		</div>
	</div>


	<!-- NAVIGATION -->
	{if !$smarty.session.detectDevice.mobile}

	<div class="row visible-md visible-lg top-container" >
	  {if $logged}

	  <div class="futureNav middle">
      <ul>
              <li>
                <a href="{$config.url}" title="{$L.NAV_DASHBOARD}" data-placement="left" >
                  {if !$user.attacksInProgress}
                  <span class="glyphicon glyphicon-dashboard"></span>
                  {else}
                  <strong class="jsFlash">({$user.attacksInProgress})</strong>
                  {/if}
                </a>
              </li>
			  <li><a href="{$config.url}zones" title="{$L.NAV_ZONES}"  data-placement="left" ><span class="glyphicon glyphicon-globe"></span></a></li>

              <li class="mid-item"><a href="{$config.url}profile" title="{$L.NAV_HEADQUARTERS}" data-placement="left"  {if $user.profileNotification}style="color:rgba(83, 195, 236, 1)"{/if}>{if $user.profileNotification}<strong class="jsFlash">({($user.friend_requests + $user.rewardsToReceive)|floatval|number_format})</strong>{else}<span class="glyphicon glyphicon-user"></span>{/if}</a></li>
			  <li><a href="{$config.url}conversations" title="{$L.NAV_CONVERSATIONS}" data-placement="left"  {if $user.newMsg}style="color:rgba(83, 195, 236, 1)"{/if}>{if $user.newMsg}<strong class="jsFlash">{$user.newMsg|floatval|number_format} {$L.UI_NEW}</strong>{else}<span class="glyphicon glyphicon-envelope"></span>{/if}</a></li>
              <li>
                <a href="{$config.url}rankings/page/{($user.rank/20)|ceil}#place_{$user.rank}" title="{$L.NAV_RANKINGS}" data-placement="left" >
                  <span class="glyphicon glyphicon-king"></span> {if $user.rank > 0} ({$user.rank|floatval|number_format}){/if}
                </a></li>

      </ul>
    </div>

    <div class="futureNav">
      <ul>
              <li><a href="{$config.url}quests" title="{$L.NAV_MISSIONS}">{if $user.in_party}<strong>{$L.NAV_PARTY}</strong>{elseif $user.partyInvites}<strong style='color:white'>{$L.NAV_PARTY} [{$user.partyInvites}]</strong>{else}<span class="glyphicon glyphicon-console"></span>{/if}</a></li>
          <li><a href="{$config.url}grid" title="{$L.NAV_GRID}"><span class="glyphicon glyphicon-th"></span></a></li>
		  <li><a href="{$config.url}servers" title="{$L.NAV_SERVERS}"><span class="glyphicon glyphicon-hdd"></span></a></li>



          <li style="width:100px;"></li>

          <li>
            <a href="{$config.url}organization" title="{$L.ORG_TITLE}">
              {if $user.org_wars}{if $user.org_wars_now}<strong class="jsFlash">{$L.NAV_ORG_WAR_NOW}</strong>{else}<strong class="jsFlash">{$L.NAV_ORG_WAR}</strong>{/if}{else}<span class="glyphicon glyphicon-tower"></span>{/if}
            </a>
          </li>
         <li><a href="{$config.url}skills" title="{$L.SKILLS_TITLE}" {if $user.skillPoints} class="jsFlash"{/if}><span class="glyphicon glyphicon-compressed"></span>{if $user.skillPoints} ({$user.skillPoints|floatval|number_format}){/if}</a></li>

          <li><a href="{$config.url}job" title="{$L.NAV_JOB}"><span class="glyphicon glyphicon-briefcase"></span></a></li>



      </ul>
    </div>


     {else}
      <div class="futureNav middle" style="margin-bottom:-15px;">
        <ul>
              <li><a href="{$config.url}rankings" title="{$L.NAV_RANKINGS}"><span class="glyphicon glyphicon-king"></span></a></li>
              <li class="mid-item"><a href="{$config.url}theWorld" title="{$L.FOOTER_WORLD_STATS}" ><span class="glyphicon glyphicon-globe"></span></a></li>
              <li><a href="{$config.url}forum" title="{$L.NAV_FORUMS}"><span class="glyphicon glyphicon-comment"></span></a></li>
        </ul>
    </div>
    <div class="futureNav">
      <ul>
        <li><a href="{$config.url}"><span class="glyphicon glyphicon-home"></span></a></li>
          <li><a href="{$config.url}register">{$L.NAV_JOIN}</a></li>
          <li><a href="{$config.url}rankings/type/orgs"><span class="glyphicon glyphicon-tower"></span></a></li>
          <li style="width:70px;"></li>
          <li><a href="{$config.url}rankings/type/blogs">{$L.NAV_BLOGS}</a></li>
          <li><a href="{$config.url}blogs/latestArticles/eve">{$L.NAV_ARTICLES}</a></li>
          <li><a href="{$config.url}support">{$L.NAV_CONTACT}</a></li>
        </ul>
    </div>
        {/if}
	</div>
	{/if}
{/if}

{if !$noHackBody}
	<div class="row-fluid hackBody mb10">


			<div class="col-md-12">{/if}

			{if $logged and $tutorial}
        <a href="#myModalmodalPopuptutorial" data-toggle="modal">
          <div class="panel panel-future">
            <div class="panel-body">
						<div class="row">
							<div class="col-xs-4">
								<a href="#myModalmodalPopuptutorial" data-toggle="modal" class="button text-center">
										{if $tutorial.status eq 1}
										<span class="glyphicon glyphicon-ok" id="tutorialIcon"></span>
										{else}
										<span class="glyphicon glyphicon-flag" id="tutorialIcon"></span>
										{/if}
								</a>
							</div>
							<div class="col-xs-8">
								<p>Tutorial ({$tutorialPercent}%)</p>
              	<div class="progress progress-small"> <div class="progress-bar" role="progressbar" style="width:{$tutorialPercent}%"> </div> </div>
							</div>
						</div>

            </div>
          </div>
        </a>


			{/if}
