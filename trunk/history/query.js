db.twitterUserStats.aggregate(
    { $project : {
     profileId : 1,
     "user.username" : 1,
     "user.userId" : 1,
     "statDate" : 1,
     "user.followersCount" : 1,
     "user.statusesCount" : 1,
     "user.retweets" : 1
  } },  
  { $match : { profileId : ObjectId("514c87080c586c7c62b57b72")} },
  { $group : {
     _id : {username: "$user.username", userID: "$user.userId" },
     currentFollowers : {$last: "$user.followersCount" },
     avgfollowers: { $avg: "$user.followersCount" },
     tweets: { $sum: "$user.statusesCount" },
     retweets: { $sum: "$user.retweets" }
  } }
)


db.clientes.aggregate(
    { $project : {
     "usuario" : 1,
     "historialPeso" : 1
  } },
    { $unwind : "$historialPeso" },
    { $project:{
        "usuario" : "$usuario",
        "historialPeso.fecha" : 1,
        "historialPeso.peso":1,
        "day" : {
            "$dayOfMonth" : "$historialPeso.fecha"
        },
        "month" : {
            "$month" : "$historialPeso.fecha"
        },
        "year" : {
            "$year" : "$historialPeso.fecha"
        }
    }},
  { $group : {
     _id : {usuario: "$usuario",day: "$day",month: "$month", year: "$year"},
     peso : {$sum: "$historialPeso.peso" }
  } }       
)