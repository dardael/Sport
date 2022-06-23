import SessionType from '../../../settings/sessions/entities/Session';
class Session {
    public id: number;
    public sessionType: SessionType;
    public value: number;
    public date: Date;
    constructor(id: number, sessionType: SessionType, value: number, date: Date) {
        this.id = id;
        this.sessionType = sessionType;
        this.value = value;
        this.date = date;
    }
}

export default Session;
