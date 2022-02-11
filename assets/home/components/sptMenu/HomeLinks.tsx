import HomeLink from "./HomeLink";
import HomeIcon from '@mui/icons-material/Home';
import SettingsIcon from '@mui/icons-material/Settings';
import React from "react";

class HomeLinks{
    static get(): HomeLink[] {
        return [
            new HomeLink('home', 'Accueil', <HomeIcon/>, '/home'),
            new HomeLink('sessionSettings', 'Paramétrage', <SettingsIcon/>, '/session/settings'),
        ]
    }

    static getHomeLink(key: string): HomeLink {
        return HomeLinks.get().find((homeLink: HomeLink) => {
           return key === homeLink.key;
        });
    }
}

export default HomeLinks;
