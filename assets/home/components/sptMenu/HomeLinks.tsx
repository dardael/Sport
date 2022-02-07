import HomeLink from "./HomeLink";
import HomeIcon from '@mui/icons-material/Home';
import SettingsIcon from '@mui/icons-material/Settings';
import React from "react";

class HomeLinks{
    static get(): HomeLink[] {
        return [
            new HomeLink('home', 'Accueil', <HomeIcon/>, '/home'),
            new HomeLink('setting', 'Paramétrage', <SettingsIcon/>, '/settings'),
        ]
    }
}

export default HomeLinks;
