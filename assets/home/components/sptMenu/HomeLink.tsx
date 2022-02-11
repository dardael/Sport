class HomeLink {
    private readonly _key: string;
    private readonly _label: string;
    private readonly _icon: JSX.Element;
    private readonly _link: string;

    constructor(key: string, label: string, icon: JSX.Element, link: string) {
        this._key = key;
        this._label = label;
        this._icon = icon;
        this._link = link;
    }

    get key(): string {
        return this._key;
    }

    get label(): string {
        return this._label;
    }

    get icon(): JSX.Element {
        return this._icon;
    }

    get link(): string {
        return this._link;
    }
}

export default HomeLink;
