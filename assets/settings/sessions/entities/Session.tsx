class Session {
    public id: number;
    public exercice: string;
    public unit: string;
    public description: string;
    public color: string;
    constructor(id: number, exercice: string, unit: string, description: string, color: string) {
        this.id = id;
        this.exercice = exercice;
        this.unit = unit;
        this.description = description;
        this.color = color;
    }

    static getUnitName(unit:string): string
    {
        switch (unit) {
            case 'rep':
                return 'Repetition';
            case 'min':
                return 'Minute';
            case 'sec':
                return 'Seconde';
            default :
                return '';
        }
    }
}

export default Session;
