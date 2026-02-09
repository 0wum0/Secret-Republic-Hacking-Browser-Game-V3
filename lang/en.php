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
];
