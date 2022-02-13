class Session {
    public id: number;
    public exercice: string;
    public unit: string;
    public description: string;
    constructor(id: number, exercice: string, unit: string, description: string) {
        this.id = id;
        this.exercice = exercice;
        this.unit = unit;
        this.description = description;
    }
}

export default Session;
