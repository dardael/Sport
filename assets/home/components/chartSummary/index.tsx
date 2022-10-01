import React from "react";
import Session from "../../../sessions/components/entities/Session";
import {BarChart, Bar, Legend, Tooltip, XAxis, YAxis, ResponsiveContainer} from "recharts";
import SessionsFormatter from "../entities/SessionsFormatter";
import SessionType from "../../../settings/sessions/entities/Session";
import Grid from "@mui/material/Grid";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";

const ChartSummary:React.FunctionComponent<{
    sessions?: Session[],
    sessionsTypes: SessionType[]
}> = ({
     sessions,
     sessionsTypes,
}) => {
    const sessionsFormatter = new SessionsFormatter(sessions, sessionsTypes);
    const usedSessionsTypes = sessionsFormatter.getSessionsTypes();
    return <>
        <Box sx={{ height: '100%',flexGrow: 1 }}>
            <Grid
                container
                direction="row"
                justifyContent="center"
                alignItems="center"
                spacing={8}
            >
            {usedSessionsTypes.map(sessionType => {
                return <Grid key={sessionType.id} item xs={12} sm md>
                    <Typography align={'center'} variant={'h5'} sx={{paddingBottom:'10px'}}>{sessionType.exercice}</Typography>
                    <ResponsiveContainer height={300}>
                        <BarChart data={sessionsFormatter.getSessionsOrderedByDate(sessionType.id)}>
                            <XAxis dataKey="date"/>
                            <YAxis/>
                            <Tooltip/>
                            <Legend/>
                            <Bar dataKey={SessionType.getUnitName(sessionType.unit)} fill={sessionType.color}/>
                        </BarChart>
                    </ResponsiveContainer>
                </Grid>
            })}
            </Grid>
        </Box>
    </>
}

export default ChartSummary;
