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
}

export default Session;
