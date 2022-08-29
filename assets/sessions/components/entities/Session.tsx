import SessionType from '../../../settings/sessions/entities/Session';
class Session {
    public id: number;
    public sessionTypeId: number;
    public value: number;
    public date: Date;
    constructor(id: number, sessionTypeId: number, value: number, date: Date) {
        this.id = id;
        this.sessionTypeId = sessionTypeId;
        this.value = value;
        this.date = date;
    }
}

export default Session;
