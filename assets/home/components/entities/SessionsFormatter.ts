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

    getSessionsOrderedByDate(sessionTypeId: number):Session[] {
        return this.sessions
            .filter((session:Session)=>session.sessionTypeId === sessionTypeId)
            .sort((aSession:Session, anotherSession:Session) => aSession.date >= anotherSession.date ? 1 : -1)
    }

    getSummedSessionsValuesByExercices() {
        let points = {};
        this.sessions.forEach(session => {
            const sessionType = this.getSessionType(session.sessionTypeId);
            if(!points[sessionType.id]){
                points[sessionType.id] = {
                    name: sessionType.exercice
                };
                points[sessionType.id][sessionType.exercice] = 0;
            }
            points[sessionType.id][sessionType.exercice]+=session.value;
        });
        return Object.values(points);
    }

    private getSessionType(sessionTypeId: number):SessionType {
        return this.sessionsTypes.find(sessionType => sessionType.id === sessionTypeId)
    }
}

export default SessionsFormatter;