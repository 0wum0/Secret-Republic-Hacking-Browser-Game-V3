<?php
/**
 * English language dictionary for Secret Republic V3.
 * Keys are prefixed: NAV_, BTN_, ERR_, MSG_, ADMIN_, INSTALL_, MAIL_, GAME_, UI_
 */
return [

    // ── Language meta ──
    'LANG_CODE'  => 'en',
    'LANG_NAME'  => 'English',
    'LANG_DIR'   => 'ltr',

    // ── Navigation (header_home.tpl) ──
    'NAV_DASHBOARD'     => 'Dashboard',
    'NAV_MISSIONS'      => 'MISSIONS',
    'NAV_SERVERS'       => 'SERVERS',
    'NAV_ORGANIZATIONS' => 'ORGANIZATIONS',
    'NAV_SKILLS'        => 'SKILLS&ABILITIES',
    'NAV_JOB_TRAIN'     => 'JOB&TRAIN',
    'NAV_HEADQUARTERS'  => 'HEADQUARTERS',
    'NAV_GRID'          => 'the GRID',
    'NAV_ZONES'         => 'ZONES',
    'NAV_RANKINGS'      => 'RANKINGS',
    'NAV_MESSAGES'      => 'MESSAGES',
    'NAV_FORUMS'        => 'FORUMS',
    'NAV_HOME_LOGIN'    => 'Home / Login',
    'NAV_NEW_ACCOUNT'   => 'New account',
    'NAV_BLOGS'         => 'Blogs',
    'NAV_ARTICLES'      => 'Articles',
    'NAV_CONTACT'       => 'Contact',
    'NAV_JOIN'          => 'Join',
    'NAV_PARTY'         => 'PARTY',
    'NAV_ORG_WAR_NOW'   => 'ORG. WAR NOW!',
    'NAV_ORG_WAR'       => 'ORG. WAR',
    'NAV_CONVERSATIONS' => 'Conversations',
    'NAV_PROFILE'       => 'Profile',
    'NAV_JOB'           => 'Job',

    // ── Footer (footer_home.tpl) ──
    'FOOTER_WORLD_STATS'    => 'World stats',
    'FOOTER_RANKINGS'       => 'Rankings',
    'FOOTER_BLOGS'          => 'blogs',
    'FOOTER_ARTICLES'       => 'articles',
    'FOOTER_FAQ'            => 'f.a.q.',
    'FOOTER_BEGINNER_INTRO' => 'beginner intro',
    'FOOTER_ABOUT'          => 'about',
    'FOOTER_FORUMS'         => 'Forums',
    'FOOTER_ARTWORK'        => 'artwork',
    'FOOTER_TOS'            => 't.o.s. & privacy',
    'FOOTER_SUPPORT'        => 'support',
    'FOOTER_GUEST'          => 'GUEST',
    'FOOTER_DEBUG_QUERIES'  => 'debug queries',

    // ── Login / Splash (splash_screen.tpl) ──
    'LOGIN_USER_PLACEHOLDER'  => 'USER',
    'LOGIN_PASS_PLACEHOLDER'  => 'PASSWORD',
    'LOGIN_CREATE_ACCOUNT'    => 'create new account',
    'LOGIN_IN_LESS_THAN'      => 'in less than a minute',
    'LOGIN_FORGOT'            => 'forgot user | pass',
    'LOGIN_OPEN_SOURCE'       => 'Open Source framework of this game on GitHub',
    'LOGIN_HACKDOWN_ENDED'    => 'Hackdown ended',
    'LOGIN_HACKDOWN_PROGRESS' => 'HACKDOWN in progress',
    'LOGIN_HACKDOWN_BEGINS'   => 'Hackdown begins in',

    // ── Registration (reg_form.tpl) ──
    'REG_QUOTE'             => '"Without the fear of our enemies, our bravery is meaningless"',
    'REG_WELCOME'           => 'Would you rather live a life of what if\'s or a life of oh well\'s?',
    'REG_USERNAME'          => 'Username',
    'REG_EMAIL'             => 'E-mail (confirmation required)',
    'REG_PASSWORD'          => 'Password',
    'REG_ZONE_INFO'         => 'Zones have long replaced countries in the new world order. The world is delimited in 6 major zones, each with its own unique qualities.',
    'REG_ACCEPT_TOS'        => 'ACCEPT OUR TOS & PRIVACY POLICY',
    'REG_SUBMIT'            => 'OBTAIN CITIZENSHIP',
    'REG_BACK_HOME'         => 'Back home?',

    // ── Setup / Installer (setup.tpl) ──
    'INSTALL_SETUP'        => 'SETUP',
    'INSTALL_DB_HOST'      => 'DB HOST',
    'INSTALL_DB_PORT'      => 'DB PORT',
    'INSTALL_DB_USER'      => 'DB USER',
    'INSTALL_DB_PASS'      => 'DB PASS',
    'INSTALL_DB_NAME'      => 'DB NAME',
    'INSTALL_ADMIN_USER'   => 'ADMIN USER',
    'INSTALL_ADMIN_PASS'   => 'ADMIN PASS',
    'INSTALL_ADMIN_EMAIL'  => 'ADMIN EMAIL',

    // ── Dashboard (index/index.tpl) ──
    'DASH_HELLO'            => 'Hello, :link. You are level :level',
    'DASH_TO_LEVEL_UP'      => ':exp to level up',
    'DASH_EXP'              => 'exp',
    'DASH_ENERGY'           => 'energy',
    'DASH_REC_RATE'         => '+rec. rate',
    'DASH_HOURLY_RECOVERY'  => 'Hourly recovery rate: 20%',
    'DASH_ALPHA_COINS'      => 'Alpha coins',
    'DASH_GET_MORE'         => 'GET MORE',
    'DASH_CONNECTED_TO'     => 'Connected to :node',
    'DASH_NOTHING_REPORT'   => 'Nothing to report',
    'DASH_NEXT_HACKDOWN'    => 'Next Hackdown in',
    'DASH_WORLD_TIMELINE'   => 'World timeline',
    'DASH_REFERRALS'        => 'Referrals',
    'DASH_SEARCH'           => 'Search',
    'DASH_NOTES'            => 'Notes',
    'DASH_DNA'              => 'DNA',

    // ── Tasks (index/tasks.tpl) ──
    'TASK_ABILITY'     => 'Ability',
    'TASK_MISSION'     => 'Mission',
    'TASK_WORKBENCH'   => 'Workbench',
    'TASK_HACKDOWN'    => 'Hackdown',
    'TASK_ORG_HACK'    => 'Org. hack',
    'TASK_TRAINING'    => 'Training',
    'TASK_WORK'        => 'Work',
    'TASK_QUEST'       => 'Quest',
    'TASK_BETA_QUEST'  => 'Beta Quest',

    // ── Missions / Quests ──
    'QUEST_NEED_SERVER'       => 'You need to have a MAIN server in order to access missions. Please proceed to building and assigning one.',
    'QUEST_MISSION_FAILED'    => 'Mission failed',
    'QUEST_MISSION_COMPLETED' => 'Mission completed',
    'QUEST_MISSIONS_LOADED'   => 'Missions interface loaded',
    'QUEST_MISSION_ACCEPTED'  => 'Mission accepted and initialised',
    'QUEST_BEEN_TRACED'       => 'You have been traced and failed the missions!',
    'QUEST_OBJ_COMPLETED'     => 'Objective completed',
    'QUEST_MISSION_COMPLETE'  => 'Mission complete',
    'QUEST_PARTY_ENDED'       => 'Party instance has ended.',
    'QUEST_SERVER_BUSY'       => 'Server is busy',
    'QUEST_MISSIONS_AVAIL'    => ':count out of :total total missions currently available in \':name\'',
    'QUEST_LOADED'            => ':title loaded',
    'QUEST_DAILY_MISSION'     => 'Daily mission',
    'QUEST_UNCOMPLETED'       => ':count uncompleted missions',
    'QUEST_NO_INCOMPLETE'     => 'no incomplete mission groups',
    'QUEST_TRAIN'             => 'TRAIN',
    'QUEST_WORK'              => 'WORK',
    'QUEST_FEEDBACK_THANKS'   => 'We are grateful for your feedback.',
    'QUEST_FEEDBACK_ERROR'    => 'Feedback error. Feedback not sent.',
    'QUEST_FEEDBACK_SUBJECT'  => 'Feedback: :name',
    'QUEST_FEEDBACK_MSG'      => 'Please leave us your feedback for this mission',

    // ── Admin Navigation ──
    'ADMIN_HACKERS'          => 'Hackers',
    'ADMIN_ONLINE'           => 'Online',
    'ADMIN_MISSIONS'         => 'Missions',
    'ADMIN_ACHIEVEMENTS'     => 'Achievs',
    'ADMIN_LEVEL_REWARDS'    => 'Lewards',
    'ADMIN_EMAIL_TEMPLATES'  => 'Email templates',
    'ADMIN_DATA'             => 'Data',
    'ADMIN_ATTACKS'          => 'Attacks',
    'ADMIN_DEBUG'            => 'Debug',

    // ── Registration / Login errors ──
    'ERR_INVALID_RESET_CODE'     => 'Invalid reset code',
    'ERR_PASSWORD_LENGTH'        => 'Password needs to have between 4 and 20 characters',
    'ERR_PASSWORD_MISMATCH'      => 'The two passwords did not match',
    'ERR_INVALID_EMAIL_FORMAT'   => 'Invalid email format',
    'ERR_RESET_LIMIT'            => 'You can request your details only once over a 12 hours period.',
    'ERR_EMAIL_NOT_FOUND'        => 'Could not find :email in our records.',
    'ERR_INVALID_EMAIL_CONFIRM'  => 'Invalid email confirmation code',
    'ERR_CREATE_ACCOUNT'         => 'Create an account?',
    'ERR_USERNAME_LENGTH'        => 'Username must be between 3 and 15 characters',
    'ERR_USERNAME_CHARS'         => 'Username may only contain letters and digits',
    'ERR_USERNAME_TAKEN'         => 'Username is taken',
    'ERR_EMAIL_TAKEN'            => 'Email is already in use',
    'ERR_NO_ZONE'                => 'You must select a zone',
    'ERR_ACCEPT_TOS'             => 'You must accept the terms of service',
    'ERR_CAPTCHA'                => 'Please complete the captcha',
    'ERR_ACCESS_DENIED'          => 'Access denied. Authentication required',

    // ── Success messages ──
    'MSG_PASSWORD_RESET'         => 'Password reset to new value',
    'MSG_EMAIL_CONFIRMED'        => 'Your email has been confirmed',
    'MSG_EMAIL_CONFIRMATION_SENT'=> 'A confirmation email valid for 48 hours has been sent your way. Please wait up to an hour to receive it before requesting again.',
    'MSG_DETAILS_SENT'           => 'We\'ve sent your details. Please wait up to an hour to receive them.',
    'MSG_HACKER_UPDATED'         => 'Hacker updated',
    'MSG_HACKER_CRED_UPDATED'    => 'Hacker credentials updated',
    'MSG_GROUP_CREATED'          => 'Group has been created',
    'MSG_GROUP_DELETED'          => 'Group has been deleted',
    'MSG_GROUP_UPDATED'          => 'Group has been updated',
    'MSG_RECORD_DELETED'         => 'Record deleted',
    'MSG_ADDED'                  => 'Added',
    'MSG_DELETED'                => 'Deleted',
    'MSG_DONE'                   => 'Done',
    'MSG_UPDATED'                => 'Updated',
    'MSG_BANNED'                 => 'Banned',
    'MSG_UNBANNED'               => 'Unbanned',

    // ── Header / Tutorial ──
    'HDR_UNCONFIRMED_EMAIL'     => 'A link to confirm your email has been sent. <a href=\':resend_url\'>Request a new email confirmation link</a>. <a href=\':change_url\'>Change email</a>?',
    'HDR_TUTORIAL_SKIPPED'      => 'Tutorial step skipped',
    'HDR_TUTORIAL_COMPLETE'     => 'Tutorial step complete',
    'HDR_TUTORIAL_FINISHED'     => 'Congratulations, you have completed the beginner introductory sequence. Let the hacking begin!',
    'HDR_TUTORIAL_REWARDS'      => 'Rewards',
    'HDR_TUTORIAL_SKIP_WARN'    => 'If you skip you will not receive any rewards for this step',
    'HDR_TUTORIAL_RECEIVE'      => 'RECEIVE REWARD AND ADVANCE',
    'HDR_TUTORIAL_SKIP'         => 'SKIP STEP :step',
    'HDR_TUTORIAL_PROGRESS'     => 'Tutorial progress [:current/:total]',
    'HDR_CARDINAL_ACTIVE'       => 'Cardinal Enforcemented Active',

    // ── Forgot Password ──
    'FORGOT_TITLE'              => 'Forgot Password',
    'FORGOT_EMAIL_PLACEHOLDER'  => 'Your email address',
    'FORGOT_SUBMIT'             => 'RECOVER',
    'FORGOT_BACK'               => 'Back to login',
    'FORGOT_NEW_PASS'           => 'New Password',
    'FORGOT_CONFIRM_PASS'       => 'Confirm Password',
    'FORGOT_RESET_SUBMIT'       => 'RESET PASSWORD',

    // ── Game generic ──
    'GAME_LEVEL'          => 'Level',
    'GAME_MONEY'          => 'Money',
    'GAME_EXP'            => 'Experience',
    'GAME_SKILL_POINTS'   => 'Skill Points',
    'GAME_ZONE'           => 'Zone',
    'GAME_CLUSTER'        => 'Cluster',
    'GAME_NODE'           => 'Node',
    'GAME_NEVER'          => 'never',
    'GAME_YES'            => 'Yes',
    'GAME_NO'             => 'No',
    'GAME_SUBMIT'         => 'Submit',
    'GAME_CANCEL'         => 'Cancel',
    'GAME_DELETE'          => 'Delete',
    'GAME_SAVE'           => 'Save',
    'GAME_CLOSE'          => 'Close',
    'GAME_BACK'           => 'Back',
    'GAME_LOADING'        => 'Loading...',
    'GAME_CONFIRM'        => 'Confirm',
    'GAME_SEARCH'         => 'Search',

    // ── UI ──
    'UI_REWARDS_TO_CLAIM' => ':count rewards to claim',
    'UI_UNREAD_EMAILS'    => ':count unread emails',
    'UI_NEW'              => 'new',
    'UI_TUTORIAL'         => 'Tutorial',
    'UI_LANGUAGE'         => 'Language',
    'UI_LANG_DE'          => 'DE',
    'UI_LANG_EN'          => 'EN',

    // ── Errors (functions.php) ──
    'ERR_UNEXPECTED'      => 'Cardinal notice: An unexpected error took place. Error recorded. Crazy people are going to look into it soon!',

    // ── Profile ──
    'PROFILE_TITLE'       => 'Profile',
    'PROFILE_FRIENDS'     => 'Friends',
    'PROFILE_ACHIEVEMENTS'=> 'Achievements',
    'PROFILE_REPUTATION'  => 'Reputation',

    // ── Organization ──
    'ORG_TITLE'           => 'Organization',
    'ORG_MEMBERS'         => 'Members',
    'ORG_WARS'            => 'Wars',
    'ORG_HACKING_POINTS'  => 'Hacking Points',

    // ── Forum ──
    'FORUM_TITLE'         => 'Forums',
    'FORUM_NEW_THREAD'    => 'New Thread',
    'FORUM_REPLY'         => 'Reply',
    'FORUM_REPLIES'       => 'Replies',

    // ── Bank ──
    'BANK_TITLE'          => 'Bank',
    'BANK_DEPOSIT'        => 'Deposit',
    'BANK_WITHDRAW'       => 'Withdraw',
    'BANK_BALANCE'        => 'Balance',

    // ── Servers ──
    'SERVERS_TITLE'       => 'Servers',
    'SERVERS_BUILD'       => 'Build Server',
    'SERVERS_HARDWARE'    => 'Hardware',
    'SERVERS_SOFTWARE'    => 'Software',

    // ── Grid ──
    'GRID_TITLE'          => 'The Grid',
    'GRID_ATTACK'         => 'Attack',
    'GRID_SPY'            => 'Spy',
    'GRID_OCCUPY'         => 'Occupy',
    'GRID_COLLECT'        => 'Collect',

    // ── Training ──
    'TRAIN_TITLE'         => 'Training',
    'TRAIN_COMPLETE'      => 'Training complete',

    // ── Skills ──
    'SKILLS_TITLE'        => 'Skills & Abilities',
    'SKILLS_POINTS_AVAIL' => 'Skill points available',

    // ── Conversations ──
    'CONV_TITLE'          => 'Conversations',
    'CONV_NEW_MSG'        => 'New Message',
    'CONV_SEND'           => 'Send',

    // ── Rankings ──
    'RANK_TITLE'          => 'Rankings',
    'RANK_PLAYERS'        => 'Players',
    'RANK_ORGS'           => 'Organizations',

    // ── Hackdown ──
    'HACKDOWN_TITLE'      => 'Hackdown',
    'HACKDOWN_ARENA'      => 'Arena',

    // ── Alpha Coins / Shop ──
    'SHOP_TITLE'          => 'Alpha Coins',
    'SHOP_BUY'            => 'Buy',
    'SHOP_ACTIVATE'       => 'Activate',

    // ── Rewards ──
    'REWARDS_TITLE'       => 'Rewards',
    'REWARDS_ACCEPT'      => 'Accept Reward',

    // ── Data Points ──
    'DP_TITLE'            => 'Data Points',

    // ── Job ──
    'JOB_TITLE'           => 'Job',

    // ── DNA / Settings ──
    'DNA_TITLE'           => 'Settings',

    // ── Search ──
    'SEARCH_TITLE'        => 'Search',

    // ── Referrals ──
    'REFERRAL_TITLE'      => 'Referrals',

    // ── Friends ──
    'FRIENDS_TITLE'       => 'Friends',

    // ── Blog ──
    'BLOG_TITLE'          => 'Blog',

    // ── Notes ──
    'NOTES_TITLE'         => 'Notes',

    // ── Storage ──
    'STORAGE_TITLE'       => 'Storage',

    // ── Achievements ──
    'ACHIEV_TITLE'        => 'Achievements',

    // ── Attacks ──
    'ATTACKS_TITLE'       => 'Attacks',

    // ── Support ──
    'SUPPORT_TITLE'       => 'Support',

    // ── FAQ ──
    'FAQ_TITLE'           => 'Frequently Asked Questions',

    // ── Zones ──
    'ZONES_TITLE'         => 'Zones',

    // ── Workbench ──
    'WORKBENCH_TITLE'     => 'Workbench',

    // ── Simulator ──
    'SIM_TITLE'           => 'Simulator',

    // ── 404 ──
    'ERR_404_TITLE'       => 'Page not found',

    // ── Misc page titles ──
    'PAGE_HOME'           => 'Home',
    'PAGE_ABOUT'          => 'About',
    'PAGE_CHANGELOG'      => 'Changelog',
    'PAGE_SHORTCUTS'      => 'Shortcuts',
    'PAGE_MEDIA'          => 'Media',
    'PAGE_PRIVACY'        => 'Privacy Policy',
    'PAGE_TOS'            => 'Terms of Service',

    // ── Visitor / Splash extras ──
    'VISITOR_AUTH_GRID'       => 'Please authenticate on the Grid.',
    'VISITOR_ACCESS_RESTRICT' => 'Access restricted.',
    'VISITOR_HACKERS_GRID'    => ':count hackers have recently connected to the Grid',
    'VISITOR_NEWEST'          => 'newest organizations && hackers',
    'VISITOR_LATEST_NEWS'     => 'latest news',
    'VISITOR_LAST_ARTICLE'    => 'last article',
    'VISITOR_RANDOM_REVIEW'   => 'Random review',

    // ── Forgot password templates ──
    'FORGOT_HEADING'          => 'forgot username <span class="glyphicon glyphicon-lock"></span> password combo',
    'FORGOT_EMAIL_PH'         => 'Email',
    'FORGOT_CONTACT_TEAM'     => 'Please contact our team if you encounter any problems.',
    'FORGOT_ENTER_NEW'        => 'enter your new password twice',
    'FORGOT_PASS_PH'          => 'Password',
    'FORGOT_CONFIRM_PH'       => 'Confirm password',
    'FORGOT_CHANGE_BTN'       => 'Change my password',

    // ── Registration system messages ──
    'ERR_EMAIL_INVALID'       => 'The email you have provided is not valid',
    'ERR_EMAIL_USED'          => ':email has already been used by another citizen.',
    'ERR_EMAIL_DNS'           => 'Cardinal System: I could not validate your email domain [:domain]. This might be an error on my part. However, make sure you have not misspelled your address.',
    'ERR_ZONE_INVALID'        => 'Invalid zone selected',
    'ERR_TOS_REQUIRED'        => 'You must agree to our Privacy Policy and Terms of Service',
    'ERR_USER_PASS_SAME'      => 'Why are your username and password the same?',
    'ERR_PASSWORD_REQ'        => 'Password must be between 4 and 20 characters.',
    'ERR_SOMETHING_WRONG'     => 'Something went terribly wrong',
    'ERR_EMAIL_CONFIRM_LIMIT' => 'You can request a new confirmation email 2 times over a 24 hours period.',
    'ERR_UNKNOWN'             => 'Unknown error took place. Please try again later!',
    'ERR_USERNAME_VALID'      => 'Username must contain only letters/numbers and have between 4 and 15 characters.',
    'ERR_USERNAME_USED'       => ':username has already been used by another citizen.',

    // ── Login system messages ──
    'LOGIN_ACCESS_DENIED'     => 'Access denied. <a href=":url">Forgot password?</a>',
    'LOGIN_SESSION_EXPIRED'   => 'Your session has expired. Authentication required.',
    'LOGIN_SESSION_ERROR'     => 'Could not create your session',
    'LOGIN_WELCOME'           => 'Welcome, :username.<br/>All systems have been initialised successfully. Grid Link: Online.',
    'LOGIN_FAILED_ATTEMPT'    => 'Failed login attempt!',
    'LOGIN_FAILED_MSG'        => 'Someone has tried and failed to login into your account. Log from :date',
    'LOGIN_ACCOUNT_BLOCKED'   => 'Account blocked',
    'LOGIN_BAN_REASON'        => 'Reason: :reason',
    'LOGIN_BAN_EXPIRES'       => 'Expires: :date',
    'LOGIN_LOGGED_OUT'        => 'You have been logged out.',

    // ── Training ──
    'TRAIN_INTRO_1'         => 'By training you will earn new skills and prepare yourself for real missions and challenges.',
    'TRAIN_INTRO_2'         => 'Forge your mind and train your hands as they\'re the most important tools a hacker needs.',
    'TRAIN_INTRO_3'         => 'The higher the difficulty the higher the chance for greater rewards.',
    'TRAIN_LOW'             => 'Low difficulty',
    'TRAIN_MID'             => 'Medium difficulty',
    'TRAIN_HIGH'            => 'High difficulty',
    'TRAIN_AGAIN_IN'        => 'You\'ll be able to train again in',
    'TRAIN_ONCE_EVERY'      => 'You can train once every :time.',
    'TRAIN_HISTORY'         => 'training history',
    'TRAIN_HISTORY_LAST'    => 'only last 10 displayed',
    'TRAIN_DONE'            => 'DONE',
    'TRAIN_FAILED'          => 'FAILED',
    'TRAIN_NO_RECORDS'      => 'no training records',
    'TRAIN_COMPLETE_TASKS'  => 'You must complete your training tasks in',
    'TRAIN_MATCH'           => 'Match',
    'TRAIN_DECRYPT'         => 'Decrypt (:count remaining)',
    'TRAIN_FIND_X'          => 'Find X so that the pattern is complete',
    'TRAIN_TIPS'            => 'You might need a pen and paper at first. Try substracting numbers that are next to each other, look carefully at the results. You\'ll soon get used to all the patterns.',
    'TRAIN_FEELING_LUCKY'   => 'I\'M FEELING LUCKY (:count remaining)',
    'TRAIN_ANSWER_PH'       => 'Answer',
    'TRAIN_ERR_CAPTCHA'     => 'Invalid decrypted data. New encrypted string fetched.',
    'TRAIN_CORRECT'         => 'Correct answer. File decrypted',
    'TRAIN_PATTERN_OK'      => 'You matched the pattern perfectly. Well done!',
    'TRAIN_PATTERN_FAIL'    => 'Incorrect answer. You can try 3 times per pattern before failing your training ^^.',
    'TRAIN_FACILITY'        => 'Training facility',

    // ── Profile ──
    'PROFILE_CHANGE'        => 'change',
    'PROFILE_LEVEL'         => 'level :level',
    'PROFILE_MEMBER_OF'     => 'Member of <a href=":url">:name</a> (#:rank)',
    'PROFILE_NO_ORG'        => 'Not part of any organization',
    'PROFILE_POINTS'        => ':points points (W#:rank/Z#:zrank)',
    'PROFILE_NO_RANK'       => 'no rank',
    'PROFILE_DNA_MGMT'      => 'DNA Management',
    'PROFILE_BANNED'        => 'Cardinal System Notice: Citizen is under arrest by the Grid Police Force. Account blocked.',
    'PROFILE_REP'           => 'Reputation',
    'PROFILE_ZONE'          => 'ZONE :zone',
    'PROFILE_BLOGS'         => 'blogs',
    'PROFILE_SUBSCRIBERS'   => ':count subscribers',
    'PROFILE_NO_BLOGS'      => ':user has no blogs',
    'PROFILE_CREATE_BLOG'   => 'Create a blog now',
    'PROFILE_FORUM_THREADS' => 'public forum threads',
    'PROFILE_REPLIES'       => ':count replies',
    'PROFILE_NO_THREADS'    => ':user has made no public threads',
    'PROFILE_GO_FORUMS'     => 'No threads. Go to forums!',
    'PROFILE_SAME_ORG'      => 'You are in the same organization as <em>:user</em>.',
    'PROFILE_FRIENDS_BTN'   => 'FRIENDS',
    'PROFILE_SEND_FR'       => 'Send friendship request',
    'PROFILE_ANSWER_FR'     => 'Answer :user\'s friend request',
    'PROFILE_CANCEL_FR'     => 'Cancel friendship request',
    'PROFILE_ACHIEV'        => 'achievements',
    'PROFILE_ACHIEV_LIST'   => 'view list of publicly available achievements',
    'PROFILE_NO_ACHIEV'     => 'No achievements :(, yet!',
    'PROFILE_LAZY'          => 'How lazy can you be?',
    'PROFILE_REP_LEVEL'     => 'You must be at least level 5 to give reputation to other hackers',
    'PROFILE_REP_LIMIT'     => 'You have already given :count reputation points in the last 24 hours',
    'PROFILE_REP_AWARDED'   => 'Reputation point awarded to :user',
    'PROFILE_FR_SENT'       => 'Friend request has been sent to :user',
    'PROFILE_FR_CANCELED'   => 'Request canceled',

    // ── Missions page extras ──
    'QUEST_FINISHED_TIMES'  => 'You\'ve finished <em>:title</em> :times times',
    'QUEST_DONE_FROM'       => ':done missions done from :avail currently available out of :total total in <strong>:name</strong>.',
    'QUEST_NO_REQUIREMENTS' => 'You have not fulfilled the requirements for any missions in this group. Complete all other available missions and work towards increasing your level to uncover hidden missions of :name.',
    'QUEST_GROUPS_INFO'     => 'Groups become available as their <strong>requirements</strong> (such as level, completing other missions, being part of a certain zone or even only at a certain time) are met.',
    'QUEST_PARTY_INFO'      => 'Selected few missions are available to parties only and will reward you more upon completion with friends.',
    'QUEST_DAILY_INFO'      => 'Some can be redone <strong>daily</strong> and others repeated at any time with no rewards to refresh your memory regarding certain facts.',
    'QUEST_REWARD_INFO'     => '<strong>Every mission reward will be delivered through <a href=":url">the Rewards Interface</a>.</strong>',
    'QUEST_HACK_POINTS_INFO'=> 'Finishing missions will earn <a href=":hp_url">Hacking Points</a> for <a href=":org_url">your Organization</a>.',
    'QUEST_COMMUNITY_INFO'  => 'This hacking competition is powered by its competitors. The more participants reach level 5 and higher the more well thought story and puzzle missions Alpha team will make available.',
    'QUEST_100_HACKERS'     => 'For every 100 hackers who reach level 5 we will add missions on top of those created on an irregular schedule.',
    'QUEST_EXTRA_REWARD'    => 'These extra missions will be a special reward for your devotement.',
    'QUEST_REFERRAL_LINK'   => 'Use <a href=":url">your referral link</a> to gain rewards.',
    'QUEST_INTERN_TEAM'     => 'Consider <a href=":url">joining the Intern Mission Engineering team</a> and doing it yourself today.',
    'QUEST_SUPPORT_NEEDED'  => 'We have part of the story written out and some amazing ideas to surprise you but we need <strong>your support</strong>!',
    'QUEST_LEVEL5_PROGRESS' => 'Hackers to reach level 5 before the next mission pack gets developed',

    // ── Admin extras ──
    'ADMIN_BAN_NEW_NOT_HIGHER' => 'New ban not higher than old ban',

    // ── Rewards Page ──
    'REWARDS_INTRO'          => 'You receive rewards as you complete different tasks, participate events or earn <a href=":url">achievements</a>.',
    'REWARDS_CLAIM_ALL'      => 'CLAIM ALL',
    'REWARDS_CLAIM'          => 'CLAIM',
    'REWARDS_NOT_CLAIMED'    => 'not claimed',
    'REWARDS_NONE_YET'       => 'You have not received any rewards, yet, :username.',
    'REWARDS_CLAIMED_ON'     => 'Claimed',
    'REWARDS_ALPHA_COINS'    => 'Alpha Coins',
    'REWARDS_DATA_POINTS'    => 'Data Points',
    'REWARDS_MONEY'          => 'Money',
    'REWARDS_EXPERIENCE'     => 'Experience',
    'REWARDS_SKILL_POINTS'   => 'Universal Skill Points',
    'REWARDS_ENERGY'         => 'Energy',
    'REWARDS_JOB_EXP'        => 'Job Experience',
    'REWARDS_SKILLS'         => 'skills',
    'REWARDS_ACHIEVEMENTS'   => 'achievements',
    'REWARDS_APPLICATIONS'   => 'Applications',
    'REWARDS_COMPONENTS'     => 'components',
    'REWARDS_CLAIM_BTN'      => 'Claim reward',
    'REWARDS_APP_HINT'       => 'To claim applications you must have space on your main server or a set as main a server which has.',
    'REWARDS_COMP_HINT'      => 'To claim components make sure to have enough space in storage.',

    // ── Job Page ──
    'JOB_LEVEL_LABEL'       => 'JOB LEVEL',
    'JOB_INTRO'             => 'The higher your job level is the more rewarding your work will be. Freelancing keeps your wallet above the floating line and trains you for missions in the field.',
    'JOB_WAIT_MSG'          => 'Gotta wait till a new day begins to work again.',
    'JOB_KEEP_CODING'       => 'Keep your code on!',
    'JOB_WORK_BTN'          => 'Work',

    // ── Storage Page ──
    'STORAGE_AREA'           => 'Storage area',
    'STORAGE_SLOTS_INFO'     => '6 slots are available by default. An extra slot is given for every 7 levels you achieve.',
    'STORAGE_MORE_SLOTS'     => 'Get more slots using A-Coins',
    'STORAGE_SELL_INFO'      => 'When selling to the Alpha\'s shop they will underevaluate items. The cash you receive decreases with damage.',
    'STORAGE_SLOTS_STATUS'   => 'You currently have :available slots available out of which :used used.',
    'STORAGE_SELL_BTN'       => 'SELL',

    // ── 404 Page ──
    'ERR_404_HEADING'        => 'ERROR 404',
    'ERR_404_BODY'           => 'System error 404 - Page not found. The page you are looking for could not be found!',
    'ERR_404_TYPED'          => 'If you\'ve typed the URL by yourself then please check it again for mistakes.',
    'ERR_404_REPORT'         => 'If you believe this page should exist then please contact our team and report the steps you\'ve gone through to reach this error.',
    'ERR_404_GO_HOME'        => 'GO TO HOME',

    // ── Hackdown texts ──
    'HACKDOWN_ENDED'         => 'Hackdown ended',
    'HACKDOWN_IN_PROGRESS'   => 'HACKDOWN in progress',
    'HACKDOWN_BEGINS_IN'     => 'Hackdown begins in',
    'HACKDOWN_NEXT_IN'       => 'Next Hackdown in',
    'HACKDOWN_ENDS_IN'       => 'Hackdown ends in',

    // ── Dashboard extras ──
    'DASH_CONNECTED_PREFIX'  => 'Connected to',

    // ── Misc UI ──
    'UI_POINTS'              => 'points',
    'UI_DAMAGED'             => 'damaged',

    // ── Rankings Page ──
    'RANK_HACKERS'           => 'Hackers',
    'RANK_HACKERS_BTN'       => 'HACKERS',
    'RANK_ORGS_BTN'          => 'ORGANIZATIONS',
    'RANK_MEMBERS'           => 'members',
    'RANK_DETAILS_LINK'      => 'Access the <strong><a href=":url">Rankings Data interface</a></strong> to find detailed information regarding your own ranking.',
    'RANK_1ST'               => '1st place',
    'RANK_2ND'               => '2nd place',
    'RANK_3RD'               => '3rd place',
    'RANK_NO_HACKERS'        => 'No hackers',

    // ── Dashboard extras (index/index.tpl) ──
    'DASH_OWN_ALPHA'         => 'You own <strong><a href=":url">:count Alpha coins</a>',
    'DASH_INCREASE_REC'      => 'Increase recovery rate?',
    'DASH_AC_BONUS'          => '+:pct% A-C bonus',

    // ── Tasks ──
    'TASK_FINISHED'          => 'Task finished',

    // ── Servers Page ──
    'SERVERS_OWN_COUNT'      => 'You own :count/:max servers. Please keep in mind only your main server contributes to your skill levels in missions.',
    'SERVERS_SET_MAIN'       => 'Set as main',
    'SERVERS_MAIN_LABEL'     => 'MAIN',
    'SERVERS_MAIN_TAG'       => '[MAIN]',
    'SERVERS_DAMAGED_PCT'    => ':amount% damaged',
    'SERVERS_UNDAMAGED'      => 'undamaged',
    'SERVERS_NO_SERVERS'     => 'you own no servers - <a href=":shop_url">buy some components</a> then <a href=":build_url">build one</a>',
    'SERVERS_BUILD_NEW'      => 'Build a new server',
    'SERVERS_CHANGE_HOST'    => 'change hostname',

    // ── Organization Hacking Points ──
    'ORG_HP_DAILY_TITLE'     => 'Daily Organization Mission - 2 hacking points reward',
    'ORG_HP_FIELD_AGAIN'     => 'You can go on the field again in',
    'ORG_HP_LABEL'           => 'hacking points',
    'ORG_HP_DESC'            => 'Hacking points are a valuable resource for organizations. These can be used and earned in various ways. Members need only complete missions and be active in the competition in order to reward their organization with hacking points.',
    'ORG_HP_EXP_DESC'        => 'Hacking Points also represent the experience the organization earns and need to level up. One hacking points is equivalent to one experience point. Upgrades and features change at times depending on the organization\'s level.',
    'ORG_HP_USE_CREDITS'     => ':name can use these credits to force wars on other organizations or to upgrade itself.',
    'ORG_HP_UPGRADE_NRM'     => 'Increase maximum number of members by 1 for :cost HP',
    'ORG_HP_RANKINGS'        => 'HP Rankings',
    'ORG_HP_HISTORY'         => 'History',
    'ORG_HP_ANCIENT'         => 'Ancient records are deleted by the Cardinal Mainframe.',
    'ORG_HP_NO_LOGS'         => 'No hacking points earnings logs.',

    // ── Grid extras ──
    'GRID_INITIATE_SPY'      => 'Initiate spy attempt',

    // ── Organization Forum ──
    'ORG_NEW_SECTION'        => 'New forum section',

    // ── Organization Wars ──
    'ORG_SEND_WAR_REQ'       => 'Send war request',

    // ── Organization Ranks ──
    'ORG_ADD_RANK'           => 'Add new rank',

    // ── Tutorial Steps ──
    'TUT_STEP1_TITLE'        => 'Step numero zero',
    'TUT_STEP1_CONTENT'      => '<p>*applause*</p>
<p>Welcome, :username,</p>
<p>To the first of a series of mini-tutorials meant to introduce you to this majestic competition.</p>
<p>Rewards await you at the end of every step.</p>
<p>First and foremost, go through <a href=\':url_tutorial\'>a short summary of available interfaces</a>.</p>
<p><strong>Connecting to your account daily will grant incremental rewards proportional with the number of consecutive days.</strong></p>
<p>The tutorial icon will keep flashing on the left. Press it when you\'re done reading the summary.</p>',

    'TUT_STEP2_TITLE'        => 'Me haz rewardz',
    'TUT_STEP2_CONTENT'      => '<p>We\'ve delivered your reward!</p>
<p>You can claim it in the Rewards Interface, where you can also find a history of your rewards.</p>
<p>Please claim all of your pending rewards.</p>',

    'TUT_STEP3_TITLE'        => 'Friends with benefits',
    'TUT_STEP3_CONTENT'      => '<p>"Friends may come and go, but enemies accumulate." ~ Thomas Jones.</p>
<p>However, the usefulness of friendships cannot be denied.</p>
<p>If you <a href=":url_dna">connect your accounts</a> you can authenticate with one click and there\'s an achievement for connecting all social accounts.</p>
<p>Considerable rewards are at stake <a href=":url_referrals">if you refer others and these rewards will keep on coming</a>.</p>
<p>Now go and check your Friends interface. You might have a request or two pending.</p>
<p>Press the top Headquarters navigation button, go to the Friends screen and make a decision for pending requests.</p>',

    'TUT_STEP4_TITLE'        => 'A server?',
    'TUT_STEP4_CONTENT'      => '<p>Servers are computers designed for heavy work.</p>
<p>To be able to do anything useful you need to configure your 1st server so please find the Servers interface.</p>
<p><strong>Buy the CHEAPEST components</strong> you find. Money does NOT grow in trees (sadly).</p>
<p>You require a Power Source, a Motherboard, a CPU, a Case, one <a title="Computer Memory Card">RAM card</a> and one <a title="Hard Disk Storage">HDD</a>.</p>
<p>Bought items go to Storage. Be careful as the storage has limited space (expands as you level or by <a href=":url_ac_storage">Alpha Coins</a>).</p>
<p>After building a server, you should visit your <a href=":url_storage">Storage</a> to mount RAM and HDD on it.</p>',

    'TUT_STEP5_TITLE'        => 'Missions',
    'TUT_STEP5_CONTENT'      => '<p>Access the missions interface.</p>
<p>Most commands you will use in missions are influenced by your skills && your main server skills and there\'s a chance they will cause damage to your software. On the Skills interface you can find out what it influences.</p>
<p><strong>This time your task is to finish the first mission in the Computer Science missions group.</strong></p>
<p>If you\'ll feel you do not have enough time in missions, you can make use of a <a href=":url_ac_time">Time Distortion Device</a>.</p>
<p>Some of the missions have been designed by hackers just like you, who joined the <a href=":url_ac_quest">Alpha Mission Designer Intern program</a>.</p>',

    'TUT_STEP6_TITLE'        => 'All for one and one for party',
    'TUT_STEP6_CONTENT'      => '<p>In the missions interface you can see that "Parties" are an option.</p>
<p>Skim a bit through the instructions for "Parties".</p>
<p>A live chat box appears to party members. <a href=":url_ac_chat">You can enable this Party Chat everywhere</a> (by default it\'s visible only in the mission interface).</p>
<p>Party members can join shared mission instances, interacting with the very same systems.</p>
<p>Your task is simple. Create a party and disband whenever you like.</p>',

    'TUT_STEP7_TITLE'        => 'the node maze',
    'TUT_STEP7_CONTENT'      => '<p>Every competitor can be found on the grid network.</p>
<p>Through the grid you can spy and attack each other. Everyone has three layers of security plus a spy layer on top of that. We will discuss them later.</p>
<p>The Grid is separated into Zones which in turn have subdivisions named clusters.</p>
<p>You can own one or multiple nodes in one or more clusters of any zone but officially you are part only of the Zone you picked at first.</p>
<p>Occupying a node is called Instantiation and can be done with specialized software.</p>
<p>In extreme situations nodes can be destroyed so it\'s better to have more than one.</p>
<p>Now take a quick look at the Grid, find a random citizen and access his profile.</p>',

    'TUT_STEP8_TITLE'        => 'dark side of the grid',
    'TUT_STEP8_CONTENT'      => '<p><a href=":url_achievements">Achievements</a> are special awards. Some improve your ranking. There are as many hidden achievements as there are public ones.</p>
<p>Your skills and server skills influence your Layers.</p>
<p>An attacker must breach through the second layer to steal anything and if he passes through the third layer more resources are stolen.</p>
<p>You can send your servers to attack and while they are in use they are not protecting you.</p>
<p>You can see the influence of every skill and server (as long as it is not in use) in the Layers Interface.</p>
<p>The <a href=":url_simulator">battle simulator</a> can attempt to predict the outcome of battles.</p>
<p>Please go to <a href=":url_grid">the Grid</a> and enter the <strong>Layers Interface</strong>.</p>',

    'TUT_STEP9_TITLE'        => 'Skills',
    'TUT_STEP9_CONTENT'      => '<p>We\'ve established that skills influence your security layers.</p>
<p>Skills also increase the efficiency and hence diminish the duration of commands execution in the missions console.</p>
<p>Access the Skills Interface upgrade your skills with all available Universal Skill Points (USP).</p>
<p>You might find yourself going through a painful trial and error process to figure out which skills are the best to use.</p>
<p>Skills are for all intents and purposes <strong>you</strong>!</p>',

    'TUT_STEP10_TITLE'       => 'Abs',
    'TUT_STEP10_CONTENT'     => '<p>Abilities enhance your skills. They have no other contributions than to give you more specific skill points.</p>
<p>You might want to see exactly to which skills each ability contributes before jumping into it.</p>
<p>You can advance to the next step as soon as you\'ve learnt an ability.</p>
<p>To access the Ability Hive, go to the Skills Interface then enter the Abilities Interface.</p>',

    'TUT_STEP11_TITLE'       => 'Server skills and apps',
    'TUT_STEP11_CONTENT'     => '<p>You are doing very well indeed. We must say we are impressed!</p>
<p>Server components and software can be damaged during Grid Battles, Missions and the lot.</p>
<p>Server skills are generated by running apps. Please buy a cheap app (in the same shop as for components), install and run it on your main server.</p>
<p>Observe the skill levels of your server changing.</p>',

    'TUT_STEP12_TITLE'       => 'Data Points',
    'TUT_STEP12_CONTENT'     => '<p>You can <a href=":url_dp">read about Data Points here</a>.</p>
<p>It\'s enough to say here that DPs are generated by servers under the influence of running apps.</p>
<p>You can <a href=":url_ac_dp">hire a Mining Consultant to increase your DP production</a>.</p>
<p>All you have to do is <a href=":url_dp">give this a quick read</a>.</p>',

    'TUT_STEP13_TITLE'       => 'Jobs',
    'TUT_STEP13_CONTENT'     => '<p>The key word is freelancing. A hacker needs money and experience and not just from missions.</p>
<p>Find the Jobs Interface and complete a job.</p>',

    'TUT_STEP14_TITLE'       => 'Training',
    'TUT_STEP14_CONTENT'     => '<p>Great! The same goes for Training.</p>
<p>Our training programs will boggle your mind but your logic will improve exponentially. You like brain teasers? TOO BAD!</p>
<p>If you find yourself stuck in a numbers problem, the forums and chats are always at your disposal.</p>
<p>Train once and we shall swiftly move on!</p>
<p>You can access the Train Interface through the Job one.</p>',

    'TUT_STEP15_TITLE'       => 'Forumsy',
    'TUT_STEP15_CONTENT'     => '<p><a href=":url_forum">Say hello to us on the forums!</a></p>
<p>Feel free to skip this step if you so desire.</p>',

    'TUT_STEP16_TITLE'       => 'Organizations',
    'TUT_STEP16_CONTENT'     => '<p>Organizations are groups of hackers with the slightest trace of a common goal. Partners in crime.</p>
<p>Organization wars make the difference between the strong.. and the weak.</p>
<p>Hacking Points help organizations improve. You can earn Hacking Points for your organization by doing normal missions, entering events and participating in the daily hacking missions in the Hacking Points interface of your organization.</p>
<p>After a while, you will be kicked out of the beginners organization. Join or create your own!</p>
<p>Your task is to find the Hacking Points Interface of your current organization (go to your organization and investigate around there).</p>
<p>If you try you might find yourself unable to complete the Hacking Points mission as you\'re not used to the console ^^. No worries, you\'ll master it very soon.</p>',

    'TUT_STEP17_TITLE'       => 'Easy peasy',
    'TUT_STEP17_CONTENT'     => '<p>About time for another easy task.</p>
<p>You can set a Youtube video to appear on your profile page! How cool is that?!</p>
<p>All you need is the video code, an example is provided in the DNA/Settings Interface.</p>
<p>Access this Interface by clicking your avatar in the dashboard or on your profile page and set a Youtube video for yourself. Optionally investigate how to update your avatar as well!</p>',

    'TUT_STEP18_TITLE'       => 'My Computer Science Degree',
    'TUT_STEP18_CONTENT'     => '<p>Last but not least, finish the "SELECT * FROM WORLD" mission available in the Computer Science missions group.</p>
<p><strong>You will have to do missions in the group one by one until you reach that one.</strong></p>
<p>Did you notice the <strong>PAUSE</strong> button available in missions?</p>
<p>Please remember to like, follow our social channels and download our mobile/tablet apps to show your support to this challenging project.</p>
<p>And we apologise beforehand for the bugs you might encounter ^^.</p>',

    // ── Admin extras ──
    'ADMIN_ADD_SKILL_EXP'    => 'Add skill experience',

    // ── Server detail page ──
    'SERVERS_IN_USE'         => ':used / :total in use',
    'SERVERS_POWER_USAGE'    => 'Power usage: :amount',
    'SERVERS_RAM_SLOTS'      => ':used / :total RAM slots',
    'SERVERS_HDD_SLOTS'      => ':used / :total HDD slots',
    'SERVERS_POWER'          => 'Power: :used/:total',
    'SERVERS_NO_RAM'         => 'no RAM mounted',
    'SERVERS_NO_HDD'         => 'no HDDs mounted',
    'SERVERS_NO_APPS'        => 'no apps installed',
    'SERVERS_NO_SKILLS'      => 'no skill levels',
    'SERVERS_CUR_SKILLS'     => 'current server skill levels',
    'SERVERS_UNMOUNT'        => 'Unmount card',
    'SERVERS_DMG_DISABLED'   => 'Disabled due to MBoard damage',
    'SERVERS_ABOUT_DMG'      => 'About software, hardware and what happens when they\'re damaged',
    'SERVERS_TRANSFER'       => 'TRANSFER',
    'SERVERS_TRANSFER_LC'    => 'transfer',

    // ── Header tutorial bar ──
    'HDR_TUTORIAL_BAR'       => 'Tutorial (:pct%)',

    // ── Grid page extras ──
    'GRID_OCCUPY_NODE'       => 'Occupy node',
    'GRID_UNINHABITED'       => 'uninhabited node',
    'GRID_INITIALIZE'        => 'initialize a node instance',
    'GRID_INACTIVE'          => 'inactive for a while',
    'GRID_SCAVENGE'          => 'Scavenge',
    'GRID_FLOATING_DP'       => ':count floating DP\'s',
    'GRID_NO_FLOATING'       => 'no <a href=":url">floating data points</a>',
    'GRID_SEND_MSG'          => 'Send message',
    'GRID_CONFIG_ATTACK'     => 'Configure attack',
    'GRID_RENAME_CLUSTER'    => '(Re)name this cluster',
    'GRID_RENAME_INFO'       => 'Cluster inhabitants can change its name every 15 days.',
    'GRID_NAME_BTN'          => 'name this cluster',
    'GRID_CLUSTER'           => 'cluster',
    'GRID_FREE_DP'           => 'Free floating Data Points scraps. Collect?',
    'GRID_NO_FLOATING_PTS'   => 'no floating points',
    'GRID_EMPTY_NODE'        => 'EMPTY NODE',
];
