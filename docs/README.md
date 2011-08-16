# SURFnet SURFconext Guest IdP #

The SURFnet SURFconext Guest IdP is the Identity Provider that connects Facebook, Google, Yahoo, Hyves, etc as identity
providers to the SURFconext platform.

## Requirements ##
* Linux
* Apache with modules:
    - mod_php
* PHP 5.3.x.
* EngineBlock

**NOTE**
While care was given to make the Guest IdP as compliant as possible with mainstream Linux distributions,
it is only regularly tested with RedHat Enterprise Linux and CentOS.


## Installation ##

If you are reading this then you've probably already installed a copy of GuestIdP somewhere on the destination server,
if not, then that would be step 1 for the installation.

If you have an installed copy and your server meets all the requirements above, then please follow the steps below
to start your installation.

### Check out the application ###

Before you can start configuring you have to check out the application (if you didn't already do so). e.g. put it
in /var/www.

### Then configure the application ###

Copy over the example configuration files and directory from the *docs/etc/* directory to */etc/surfconext/*:

    sudo mkdir /etc/surfconext
    sudo cp -Rvf docs/etc/* /etc/surfconext/

Then edit the copied files with your favorite editor and review the settings to make sure it matches your configuration.

### Configure HTTP server ###

Install 1 virtual Hosts

**EXAMPLE**

    <VirtualHost *:443>
            ServerAdmin admin@example.com
            DocumentRoot /var/www/guestidp/www
            ServerName guestidp.example.com

            Alias /simplesaml /var/www/guestidp/www

            SSLEngine on
            SSLCertificateFile /etc/httpd/ssl/coin.pem
            SSLCertificateKeyFile /etc/httpd/ssl/coin.key
            SSLCertificateChainFile /etc/httpd/ssl/coin-chain.pem
    </VirtualHost>

Make sure you have the following alias (or it's functional equivalent):

    Alias /simplesaml /var/www/guestidp/www

### Setup Logging ###

You can have Simplesaml log to different destinations, e.g. file or syslog.

By default the GuestIdP logs to file.

Create the following directory to correctly enable logging:

    mkdir /var/log/surfconext

NB. Make sure that this directory is read/writable by the User that starts apache.

To enable logging to syslog, add the following entry to the *guestidp.config.php* file located at */etc/surfconext*:

    $config['logging.handler'] = 'syslog';

### Configure Engineblock as the SP ###

change the *guestidp.saml20-sp-remote.php* file located in */etc/surfconext/* according to the Engineblock  you are
connecting to:

    unset($metadata['https://engine.surfconext.nl/authentication/sp/metadata']);
    $metadata['https://engine.dev.surfconext.nl/authentication/sp/metadata'] = array(
            'AssertionConsumerService' => 'https://engine.dev.surfconext.nl/authentication/sp/consume-assertion',
            'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
            'simplesaml.nameidattribute' => 'urn:mace:dir:attribute-def:uid',
    );

### Register the Guest IdP in the Service Registry ###

Add the Guest IdP instance to the service registry.

The Metadata URL and Entity ID are: http://guestidp.example.com/simplesaml/saml2/idp/metadata.php

### Configure Facebook Authentication ###

In order to use the facebook authentication you must register a new application with Facebook. Browse to:
http://www.facebook.com/developers

After you have authenticated, click on '+ Set up New App' to create a new application.

Enter the following information in the application:

    About tab:
        App name: GuestIdP SURFnet (DEV) (Replace dev with the environment you are working on)
        Description:
        icon: download the SURFnet icon from https://espee.surfnet.nl/favicon.ico
        Logo: Download the SURFnet logo from https://espee.surfnet.nl/federate/surfnet/img/logo/surfnet.jpg
        Language: EN
        Contact Email: coin-beheer@surfnet.nl
        Privacy Policy URL:
        User Agreement URL:

    Web site tab:
        Site URL: https://guestidp.dev.coin.surf.net/simplesaml/module.php/authfacebook/linkback.php?next (make sure to replace the domain with the domain corresponding to you environment)
        Site Domain: guestidp.dev.coin.surf.net

NB. Change the values according to your environment

After you have registered your application with Facebook, copy the API-key and App secret.
Add them to the *guestidp.authsources.config.php* located at */etc/surfconext/* like the example below:

    $config['facebook'] = array(
        'authfacebook:Facebook',
        'api_key' => 'YOUR_API_KEY',
        'secret' => 'YOUR_FACEBOOK_APP_SECRET',
    );

### Configure Twitter Authentication ###

The Twitter authentication setup is similar to the facebook authentication setup. You once again have to register an application.
go to:

    http://twitter.com/apps and click on 'Register a new Application'.

Enter the following information:

    Application name: GuestIdP SURFnet (DEV) (Replace dev with the environment you are working on)
    Description: SURFnet Guest Identity Provider
    Application website: https://gui.dev.coin.surf.net/coin (the SURFconext portal url)
    Organization: SURFnet B.V.
    Website: http://www.surfnet.nl
    Application type: Browser
    Callback URL: https://guestidp.dev.coin.surf.net/simplesaml/module.php/authtwitter/linkback.php (make sure to replace the domain with the domain corresponding to you environment)
    Default Access Type: Read-only
    Use Twitter for Login: Yes

NB. Change the values according to your environment

After you have registered your application with Twitter, copy the key and secret.
Add them to the *guestidp.authsources.config.php* located at */etc/surfconext/* like the example below:

    $config['twitter'] = array(
        'authtwitter:Twitter',
        'key' => 'YOUR_KEY',
        'secret' => 'YOUR_SECRET',
    );

### Test your Guest IdP instance ###

Go to your the following Url: https://guestidp.example.com/simplesaml/module.php/core/authenticate.php
Click on 'multi'

Now you should see a screen where you can select multiple authentication sources.

You should now be able to log in to all authentication sources successfully via your configured EngineBlock instance.

## Updating ##

It is recommended practice that you deploy the Guest IdP in a directory that includes
the version number and use a symlink to link to the 'current' version of the Guest IdP.

**EXAMPLE**

    .
    ..
    guestidp -> guestidp-v1.6.0
    guestidp-v1.5.0
    guestidp-v1.6.0

If you are using this pattern, an update can be done with the following:

1. Download and deploy a new version in a new directory.

2. Check out the release notes in docs/release_notes/X.Y.Z.md (where X.Y.Z is the version number) for any
   additional steps.

3. Change the symlink.
