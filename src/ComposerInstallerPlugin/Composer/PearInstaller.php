<?php

namespace ComposerInstallerPlugin\Composer;

use Composer\Composer;
use Composer\Package\PackageInterface;
use Composer\Installer\PearInstaller;

class PearInstaller extends PearInstaller
{
  public function getInstallPath(PackageInterface $package)
  {
    $names = $package->getNames();
    if ($this->composer->getPackage()) 
    {
      $extra = $this->composer->getPackage()->getExtra();
      if(!empty($extra['installer-paths']))
      {
        foreach($extra['installer-paths'] as $path => $packageNames)
        {
          foreach($packageNames as $packageName)
          {
            if (in_array($packageName, $names)) {
              return $path;
            }
          }
        }
      }
    }

    /*
     * In case, the user didn't provide a custom path
     * use the default one, by calling the parent::getInstallPath function
     */
    return parent::getInstallPath($package);
  }
}
