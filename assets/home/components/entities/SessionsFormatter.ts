import Session from "../../../sessions/components/entities/Session";
import SessionType from "../../../settings/sessions/entities/Session";

class SessionsFormatter {
    private sessions:Session[];
    private sessionsTypes:SessionType[];
    constructor(sessions:Session[], sessionsTypes:SessionType[]) {
        this.sessions = sessions;
        this.sessionsTypes = sessionsTypes;
    }

    getSessionsTypes(): SessionType[] {
        return [... new Set(this.sessions.map((session:Session) => session.sessionTypeId))]
            .map(sessionTypeId => this.getSessionType(sessionTypeId));
    }

    getSessionsOrderedByDate(sessionTypeId: number) {
        const sessionType = this.getSessionType(sessionTypeId);
        const sessionUnit = SessionType.getUnitName(sessionType.unit)
        return this.sessions
            .filter((session:Session)=>session.sessionTypeId === sessionTypeId)
            .sort((aSession:Session, anotherSession:Session) => aSession.date >= anotherSession.date ? 1 : -1)
            .map((session:Session) => {
                let point = {date: (new Date(session.date)).toLocaleDateString()};
                point[sessionUnit] = session.value
                return point
            })
    }

    getSummedSessionsValuesByExercices() {
        let points = {};
        this.sessions.forEach(session => {
            const sessionType = this.getSessionType(session.sessionTypeId);
            const sessionUnit = SessionType.getUnitName(sessionType.unit)
            if(!points[sessionType.id]){
                points[sessionType.id] = {
                    name: sessionType.exercice
                };
                points[sessionType.id][sessionUnit] = 0;
            }
            points[sessionType.id][sessionUnit]+=session.value;
        });
        return Object.values(points);
    }

    private getSessionType(sessionTypeId: number):SessionType {
        return this.sessionsTypes.find(sessionType => sessionType.id === sessionTypeId)
    }
}

export default SessionsFormatter;
